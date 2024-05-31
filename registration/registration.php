<?php

session_start();
include "connection.php";
// include '../sendMail.php';

// Define referral bonuses for each level
$referralBonuses = [
    1 => 100,  // Referral bonus for level 1
    2 => 50,   // Referral bonus for level 2
    3 => 30,   // Referral bonus for level 3
    4 => 20,   // Referral bonus for level 4
    5 => 10,   // Referral bonus for level 5
    6 => 0,   // Referral bonus for level 6
    7 => 0,   // Referral bonus for level 7
    8 => 0,   // Referral bonus for level 8

];


if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $pass = $_POST['password'];
    $cpassword = $_POST['confirm_password'];
    $dob = $_POST['dob'];
    $referral = $_POST['referral'];
    $setStatus = 1;
    $date = date('Y-m-d H:i:s');

    // if user blocked also referral code block 

    $selectQuery = "SELECT * FROM registration WHERE `referral`='$referral'";
    $result = mysqli_query($conn, $selectQuery);
    $num = mysqli_num_rows($result);
    if ($num > 0) {
        $statusRow = mysqli_fetch_assoc($result);
        if ($statusRow['status'] == 0) {
            $_SESSION['error'] = 'you can not use this code , sponserId blocked';
            header("location: http://localhost/amit_php/registration/index.php");
            exit();
        }
    }

    $fetch = "SELECT * FROM registration WHERE email='$email'OR mobile='$mobile'";
    $res = mysqli_query($conn, $fetch);
    $num = mysqli_num_rows($res);
    if ($num > 0) {
        $row = mysqli_fetch_assoc($res);
        if ($row['email'] == $email) {
            $_SESSION['error'] = 'email already';
            header("location: http://localhost/amit_php/registration/index.php");
            exit();
        } elseif ($row['mobile'] == $mobile) {
            $_SESSION['error'] = 'mobile already';
            header("location: http://localhost/amit_php/registration/index.php");
            exit();
        }
    }
    // Password validation
    if (preg_match('/\s/', $pass)) {
        $_SESSION['error'] = "Password contains whitespace!";
        header("location: http://localhost/amit_php/registration/index.php");
        exit();
    }
    if (strlen($pass) < 8) {
        $_SESSION['error'] = "Password must be at least 8 characters long!";
        header("Location: http://localhost/amit_php/registration/index.php");
        exit();
    }
    if ($pass !== $cpassword) {
        $_SESSION['error'] = "Passwords do not match.";
        header("location: http://localhost/amit_php/registration/index.php");
        exit();
    }

    // Generate referral code
    $generateReferralCode = random_int(10000, 99999);

    // referral system => level 
    if (empty($referral)) {
        // User registers without a referral
        $signupBonus = 75;
        $sponsorUserId = strtoupper(bin2hex(random_bytes(2)));

        $insert = "INSERT INTO Registration(user_id, names, email, mobile, pass, dob, referral, total_amt,`status`,level1,level2,level3,level4,level5,level6,level7,level8,register_date) VALUES('" . $sponsorUserId . "','" . $name . "','" . $email . "','" . $mobile . "','" . $pass . "','" . $dob . "','" . $generateReferralCode . "',$signupBonus,'" . $setStatus . "','','','','','','','','','" . $date . "')";
        $re = mysqli_query($conn, $insert);

        // Insert into wallet
        $insertWallet = "INSERT INTO `wallet` (`user_id`, `from`, `to`, `type`, `time`, `amount`, `create_date`, `update_date`) VALUES ('" . $sponsorUserId . "','Admin', '" . $sponsorUserId . "', 'Signup Bonus','" . $date . "' , '$signupBonus', CURRENT_TIMESTAMP(), CURRENT_TIMESTAMP())";
        $re = mysqli_query($conn, $insertWallet);
    } else {
        // User registers with a referral
        $fetchReferral = "SELECT * FROM registration WHERE referral = '$referral'";
        $resReferral = mysqli_query($conn, $fetchReferral);
        $numReferral = mysqli_num_rows($resReferral);

        if ($numReferral > 0) {
            $rowReferral = mysqli_fetch_assoc($resReferral);
            $referralUserId = $rowReferral['user_id'];
            $referral = $rowReferral['referral'];
            $signupBonus = 75;
            $referralBonus = 100;
            $newUserId = strtoupper(bin2hex(random_bytes(2)));

            // Insert new user
            $insert = "INSERT INTO Registration(user_id, names, email, mobile, pass, dob, referral,joining_referral, total_amt,`status`,level1,level2,level3,level4,level5,level6,level7,level8,register_date) VALUES('" . $newUserId . "','" . $name . "','" . $email . "','" . $mobile . "','" . $pass . "','" . $dob . "','" . $generateReferralCode . "','" . $referral . "','" . $signupBonus . "','" . $setStatus . "','','','','','','','','','" . $date . "')";
            $re = mysqli_query($conn, $insert);

            // Insert referral bonus transaction
            $insertReferralWallet = "INSERT INTO `wallet` (`user_id`, `from`, `to`, `type`, `time`, `amount`, `create_date`, `update_date`) VALUES ('" . $referralUserId . "','" . $newUserId . "', '" . $referralUserId . "', 'Referral Bonus', '" . $date . "', '$referralBonus', CURRENT_TIMESTAMP(), CURRENT_TIMESTAMP())";
            $resultReferralWallet = mysqli_query($conn, $insertReferralWallet);

            // Process referral levels
            function updateReferralBonus($level, $referrerUserId, $newUserId, $bonus, $conn)
            {
                $date = date('Y-m-d H:i:s');
                $updateQuery = "UPDATE registration SET total_amt = total_amt + $bonus, `level$level` = IFNULL(CONCAT(`level$level`, ' $newUserId'), '$newUserId') WHERE user_id = '$referrerUserId'";
                $resultUpdate = mysqli_query($conn, $updateQuery);

                // Insert into wallet
                $insertWalletQuery = "INSERT INTO `wallet` (`user_id`, `from`, `to`, `type`, `time`, `amount`, `create_date`, `update_date`) VALUES ('$referrerUserId', '$newUserId', '$referrerUserId', 'Referral Level $level Bonus', '" . $date . "', '$bonus', CURRENT_TIMESTAMP(), CURRENT_TIMESTAMP())";
                $resultWallet = mysqli_query($conn, $insertWalletQuery);

                return $resultUpdate && $resultWallet;
            }

            function processReferralLevel($level, $referral, $newUserId, $conn)
            {
                global $referralBonuses;

                $fetchReferralQuery = "SELECT * FROM registration WHERE referral = '$referral'";
                $resReferral = mysqli_query($conn, $fetchReferralQuery);
                $numReferral = mysqli_num_rows($resReferral);

                if ($numReferral > 0 && isset($referralBonuses[$level])) {
                    while ($rowReferral = mysqli_fetch_assoc($resReferral)) {
                        $referrerUserId = $rowReferral['user_id'];
                        $bonus = $referralBonuses[$level];
                        updateReferralBonus($level, $referrerUserId, $newUserId, $bonus, $conn);

                        if ($level < 10) {
                            processReferralLevel($level + 1, $rowReferral['joining_referral'], $newUserId, $conn);
                        }
                    }
                }
            }
            processReferralLevel(1, $referral, $newUserId, $conn);
        }
    }
    if ($re) {
        $_SESSION['referral_Code'] = $generateReferralCode;
        $_SESSION['registration_alert'] = "Registration successful. Please login.";
        header("location: http://localhost/amit_php/registration/index.php");
        exit();
        // sending mail
        sendMail($email, $name);
    } else {
        $_SESSION['error'] = "Error occurred during registration.";
        header("location: http://localhost/amit_php/registration/index.php");
        exit();
    }
} else {
    $_SESSION['error'] = "Referral code not found.";
    header("location: http://localhost/amit_php/registration/index.php");
    exit();
}
