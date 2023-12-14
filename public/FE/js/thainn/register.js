// function Register(){
//     let name = '';
//     let email = '';
//     let password = '';
   
//     let inputName = document.getElementsByClassName('username');
//     let inputEmail = document.getElementsByClassName('email');
//     let inputPassword = document.getElementsByClassName('password');
//     for (let item of inputName) {
//         if (item.value !== '') {
//             name = item.value;
//             break;
//         }
//     }
//     for (let item of inputEmail) {
//         if (item.value !== '') {
//             email = item.value;
//             break;
//         }
//     }
//     for (let item of inputPassword) {
//         if (item.value !== '') {
//             password = item.value;
//             break;
//         }
//     }
//     for (let item of inputConfirmPassword) {
//         if (item.value !== '') {
//             confirmPassword = item.value;
//             break;
//         }
//     }
//     $.ajax({
//         url: 'http://127.0.0.1:8000/api/register',
//         type: 'POST',
//         data: JSON.stringify({
//             "username": name, "email": email, "password": password
//         }), contentType: 'application/json',
//         success: function (data) {
//             let user = new User(email, password);
//             localStorage.setItem("account", JSON.stringify(user));
//             window.location.href = 'http://127.0.0.1:8000/home';
//         }, error: function (err) {
//            alert('Email đã được đăng ký!');
//         }
//     });
// }