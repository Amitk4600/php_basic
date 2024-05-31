
<?php
echo
"<script>
 function togglePasswordVisibility(inputId) {
    let passwordInput = document.getElementById(inputId);
    let eyeIcon = document.getElementById('eyeicon_' + inputId);

    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
       
    } else {
        passwordInput.type = 'password';
       
    }
}

</script>"
?>