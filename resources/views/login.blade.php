<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
</head>

<body>
    <style>
        .main {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        box-sizing: border-box;
    }
    .card {
        width: 23rem;
    }

    .password-container {
            position: relative;
        }
    .toggle-password {
            position: absolute;
            right: 35px;
            top: 73%;
            transform: translateY(-50%);
            cursor: pointer;
        }
    
    .alert {
            position: absolute;
            top: 100px;
            left: 50%;
            transform: translateX(-50%);
            background-color: rgba(255, 0, 0, 0.1);
            padding: 10px;
            border-radius: 5px;
            z-index: 1000;
        }
    .card {
            position: relative;
        }
    </style>

    </style>
    <body>
        <div class="main flex-column">
        @if (session('error'))
            <div class="alert alert-danger d-flex align-items-center" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                </svg>
                <div>
                    {{ session('error') }}
                </div>
            </div>
        @endif
        
        
            <div class="card">
                <form action="" method="post">
                    @csrf
                    <div class="card-header text-center p-4">
                        <img src="/image/logo_taka2.png" style="width: 300px;">
                    </div>
                    <div class="card-body p-4">
                        <div class="mb-2">
                            <input type="text" name="username" id="username" class="form-control" placeholder="Username" required>
                        </div>
                        <div>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                            <span class="toggle-password" onclick="togglePassword()">
                                <i class="bi bi-eye" id="eye-open"></i>
                                <i class="bi bi-eye-slash" id="eye-close" style="display: none"></i>
                            </span>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div>
                            <button type="submit" class="btn btn-primary form-control">Login</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/js/script.js"></script>

    <script>
        function togglePassword() {
        var passwordInput = document.getElementById('password');
        var eyeOpenIcon = document.getElementById('eye-open');
        var eyeCloseIcon = document.getElementById('eye-close');
        
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            eyeOpenIcon.style.display = "none";
            eyeCloseIcon.style.display = "inline";
        } else {
            passwordInput.type = "password";
            eyeOpenIcon.style.display = "inline";
            eyeCloseIcon.style.display = "none";
        }
    }
    </script>
</body>

</html>