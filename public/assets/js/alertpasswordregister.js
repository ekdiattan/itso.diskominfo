 // Pisah
 const passwordInput = document.getElementById('password');
 const passwordStrength = document.getElementById('password-strength');
 const submitBtns = document.getElementById('submit-btn');
 const password = document.getElementById('password');

 document.getElementById("submit-btn").disabled = false;

 function validateForm() {
     if (password.value.trim() === '') {
         submitBtn.disabled = false;
     } else {
         submitBtn.disabled = true;
     }
 }

 password.addEventListener('input', validateForm);
 passwordInput.addEventListener('input', function () {
     // mengambil nilai password dari input
     const password = passwordInput.value;

     // memeriksa apakah password memenuhi kriteria
     const hasNumber = /\d/.test(password);
     const hasSymbol = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/.test(password);
     const hasUppercase = /[A-Z]/.test(password);

     // menampilkan alert sesuai dengan hasil pengecekan
     if (password.length === 0) {
         passwordStrength.innerHTML = '';
         submitBtns.disabled = true;
     } else if (password.length < 6) {
         passwordStrength.innerHTML = 'Password kurang dari 6 karakter!';
         submitBtns.disabled = true;
     } else if (!hasNumber) {
         passwordStrength.innerHTML = 'Password harus mengandung nomor!';
         submitBtns.disabled = true;
     } else if (!hasUppercase) {
         passwordStrength.innerHTML = 'Password harus mengandung kapital!';
         submitBtns.disabled = true;
     } else {
         passwordStrength.innerHTML = 'Password kuat!';
         submitBtns.disabled = false;
     }
 });