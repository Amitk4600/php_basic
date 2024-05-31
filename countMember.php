<?php

$id = $_SESSION['id'];
// count all level member
function levelMemberFunction($conn, $referral, $a, $level)
{
   $x = "SELECT * FROM registration WHERE `joining_referral` = '" . $referral . "'";
   $y = mysqli_query($conn, $x);
   $n = mysqli_num_rows($y);
   if ($n > 0) {
      $level++;
      while ($fetch1 = mysqli_fetch_assoc($y)) {
         $fetch1['level'] = $level;
         $aa = array_push($a, $fetch1);
         $a = levelMemberFunction($conn, $fetch1['referral'], $a, $level);
      }
   }
   return $a;
}

$a = [];
$query = "SELECT * FROM `registration` WHERE `user_id` = '" . $id . "'";
$queryResult = mysqli_query($conn,$query);
$fetchQuery = mysqli_fetch_assoc($queryResult);
$queryReferralJoining = $fetchQuery['joining_referral'];
$referralId = $queryReferralJoining; //userid or referral
$qury = "SELECT * FROM `registration` WHERE `joining_referral` = '" . $referralId . "'";

$result = mysqli_query($conn, $qury);
$num = mysqli_num_rows($result);

if ($num > 0) {
   while ($fetch = mysqli_fetch_assoc($result)) {
      $level = 1;
      $fetch['level'] = $level;
      $aa = array_push($a, $fetch);
      $a = levelMemberFunction($conn, $fetch['referral'], $a, $level);
   }
}
function compare_level($a1, $b1)
{
   $retval = $a1['level'] - $b1['level'];
   return $retval;
}
usort($a, 'compare_level');
$count = count($a);
echo "<h4>main total team $count</h4>";
echo "<br>";

// $sqlQuery = "SELECT * FROM  registration  WHERE `user_id` = '$id'";
// $sqlResult = mysqli_query($conn, $sqlQuery);
// $sqlNums = mysqli_num_rows($sqlResult);
// $sqlArr = [];
// $level =1;

// if ($sqlNums > 0) {
//    while ($sqlRows = mysqli_fetch_assoc($sqlResult)) {
//       $sqlReferral = $sqlRows['referral'];
//       $sqlQuery1 = "SELECT * FROM  registration As `level` WHERE `joining_referral` = '$sqlReferral'";
//       $sqlResult1 = mysqli_query($conn, $sqlQuery1);
//       $sqlRows['level'] = $level;
//       $level++;
//       echo "<pre>";
//       $sqlPush = array_push($sqlRows);
//       $sqlNums1 = mysqli_num_rows($sqlResult1);
//    }
//    echo "<h1>total team count member : $sqlPush<br></h1>";
// }





// function xyz($conn, $referral, $level1)
// {
//    $query = "SELECT * FROM  registration  WHERE `joining_referral` = '$referral'";
//    $result = mysqli_query($conn, $query);
//    $abc = [];
//    while ($rows = mysqli_fetch_assoc($result)) {
//       $rows['level'] = $level1;
//       $abc[] = $rows;
//       $abc = array_merge($abc, xyz($conn, $rows['referral'], $level1 + 1));
//    }
//    mysqli_free_result($result);
//    return $abc;
// }
// $quryy = "SELECT * FROM `registration` WHERE `user_id` = '" . $id . "'";
// $quryyResult = mysqli_query($conn,$quryy);
// $fetchQuryy = mysqli_fetch_assoc($quryyResult);
// $quryyReferral = $fetchQuryy['joining_referral'];
// $referrId = $quryyReferral;
// $abc = xyz($conn, $referrId, 1);
// function compare_level1($ab1, $bb1)
// {
//    return $ab1['level'] - $bb1['level'];
// }
// usort($abc, 'compare_level1');
// $count = count($abc);
// echo "total team Member<h1>$count</h1>";
// echo "<br>";

// function levelMember($conn, $referral, $a, $level)
// {
//    $query = "SELECT * FROM registration AS `level` WHERE `joining_referral` = $referral";
//    $result = mysqli_query($conn, $query);
//    while ($member = mysqli_fetch_assoc($result)) {
//       $member['level'] = $level;
//       $a[] = $member;
//       $a = array_merge($members, levelMember11($conn, $member['referral'], $level + 1));
//    mysqli_free_result($result);
//    return $a;
// }
// $a = [];
// $id = 46800;
// $sqlQuery = "SELECT * FROM registration AS `level` WHERE `joining_referral` = '$id'";

// $result = mysqli_query($conn, $sqlQuery);
// while ($member = mysqli_fetch_assoc($result)) {
//    $member['level'] = 1;
//    $a = levelMember($conn, $referral = $member['referral'], $a, $level = $member['level']);
// }
// mysqli_free_result($result);
// function compare_level1($a1, $b1)
// {
//    $retval = $a1['level'] - $b1['level'];
//    return $retval;
// }
// usort($a, 'compare_level1');
// $count = count($a);
// echo "total team Member<h1>$count</h1>";
// echo "<br>";

//**************************************************** */


// optimized 1

// function levelMember11($conn, $referral, $level)
// {
//    $query = "SELECT * FROM registration WHERE `joining_referral` = '$referral'";
//    $resultt = mysqli_query($conn, $query);
//    $members = [];
//    while ($member = mysqli_fetch_assoc($resultt)) {
//       $member['level'] = $level;
//       $members[] = $member;
//       // Recursively fetch members at deeper levels
//       $members = array_merge($members, levelMember11($conn, $member['referral'], $level + 1));
//    }
//    mysqli_free_result($resultt);
//    return $members;
// }
// $queryy = "SELECT * FROM `registration` WHERE `user_id` = '" . $id . "'";
// $queryyResult = mysqli_query($conn,$queryy);
// $fetchQueryy = mysqli_fetch_assoc($queryyResult);
// $queryyReferralJoining = $fetchQueryy['joining_referral'];
// $idd = $queryyReferralJoining;
// $abc = levelMember11($conn, $idd, 1);
// function compare_level11($abc, $xyz)
// {
//    return $abc['level'] - $xyz['level'];
// }
// usort($abc, 'compare_level11');
// $count = count($abc);
// echo "<h1> optimized  Total team members: $count</h1>";
// echo "<br>";

//**************************************************** */
// optimized 2
// function levelMemberFunction1($conn, $referral, $members, $level)
// {
//    $sql = "SELECT *, " . ($level + 1) . " AS level FROM registration WHERE joining_referral = '" . $referral . "'";
//    $result = mysqli_query($conn, $sql);
//    while ($member = mysqli_fetch_assoc($result)) {
//       $members[] = $member;
//       $members = levelMemberFunction1($conn, $referral = $member['referral'], $members, $member['level']);
//    }
//    mysqli_free_result($result);
//    return $members;
// }

// $members = [];
// $referralId = 46800;
// $sql = "SELECT * FROM registration WHERE joining_referral = '" . $referralId . "'";
// $result = mysqli_query($conn, $sql);
// while ($member = mysqli_fetch_assoc($result)) {
//    $member['level'] = 1;
//    $members = levelMemberFunction1($conn, $referral = $member['referral'], $members, 1);
// }
// mysqli_free_result($result);
// function compare_level111($a, $b) {
//    return $a['level'] - $b['level'];
// }
// usort($members, 'compare_level111');
// // $count = count($members);
// $count = count($a);
// echo "<h3>optimized 2 total team $count</h3>";

//**************************************************** */
// main code 


// 3rd optimized 


// function numrows($exe)
// {
//     return mysqli_num_rows($exe);
// }

// function query($conn, $sql)
// {
//     return mysqli_query($conn, $sql);
// }

// function levelMemberFunctionTeam($conn, $referral, &$a, $level)
// {
//     $x = "SELECT * FROM registration WHERE `joining_referral` = '" . $referral . "'";
//     $y = mysqli_query($conn, $x);
//    $n = mysqli_num_rows($y);
//    if ($n > 0) {
//       $level++;
//       while ($fetch1 = mysqli_fetch_assoc($y)) {
//          $fetch1['level'] = $level;
//          $aa = array_push($a, $fetch1);
//          $a = levelMemberFunction($conn, $fetch1['referral'], $a, $level);
//       }
//    }
//    return $a;
// }

// $a = [];
// $queery = "SELECT * FROM `registration` WHERE `user_id` = '" . $id . "'";
// $queryResult = mysqli_query($conn,$queery);
// $fetchQueery = mysqli_fetch_assoc($queryResult);
// $queryReferral = $fetchQueery['joining_referral'];

// $uuuid = $queryReferral; //userid
// $qury = "SELECT * FROM `registration` WHERE `joining_referral` = '" . $uuuid . "'";
// $result = query($conn, $qury);
// if ($num > 0) {
//    while ($fetch = mysqli_fetch_assoc($result)) {
//       $level = 1;
//       $fetch['level'] = $level;
//       $aa = array_push($a, $fetch);
//       $a = levelMemberFunction($conn, $fetch['referral'], $a, $level);
//    }
// }
// function compare_levelTeam($a1, $b1)
// {
//    $retval = $a1['level'] - $b1['level'];
//    return $retval;
// }
// usort($a, 'compare_levelTeam');
// $Team = count($a);
// echo "<h4> modified main total team=>    $Team</h4>";
// echo "<br>";
