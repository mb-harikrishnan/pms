@include('staff::layouts.header')
<main class="admin-content">

    <div class="content-wrapper">

        <!-- Page Header -->
        <div class="page-header">
            <h2>Change Password</h2>
        </div>

        <!-- Form Card -->
        <div class="form-card">
            <form method="POST" action="{{route('admin.save_password')}}" id="changePasswordForm">
                @csrf

                <div class="form-row">
                    <div class="form-group password-wrapper">
                        <label>Old Password</label>
                        <input type="password" name="old_password" id="old_password" placeholder="Enter old password">
                        <span class="toggle-password" data-target="old_password">
                            <i class="ri-eye-line"></i>
                        </span>
                        @error('old_password')
                            <small class="error-text">{{ $message }}</small>
                        @enderror
                    </div>

                </div>

                <div class="form-row">
                    <div class="form-group password-wrapper">
                        <label>New Password</label>
                        <input type="password" name="new_password" id="new_password" placeholder="Enter new password">
                        <span class="toggle-password" data-target="new_password">
                            <i class="ri-eye-line"></i>
                        </span>
                        @error('new_password')
                            <small class="error-text">{{ $message }}</small>
                        @enderror
                    </div>



                </div>

                <div class="form-row">
                    <div class="form-group password-wrapper">
                        <label>Confirm New Password</label>
                        <input type="password" name="confirm_password" id="confirm_password"
                            placeholder="Confirm new password">
                        <span class="toggle-password" data-target="confirm_password">
                            <i class="ri-eye-line"></i>
                        </span>
                        @error('confirm_password')
                            <small class="error-text">{{ $message }}</small>
                        @enderror
                    </div>






                </div>

                <button type="submit" class="save-btn">Update Password</button>
            </form>


        </div>

    </div>

</main>


<style>
    .password-wrapper {
        position: relative;
    }

    .password-wrapper input {
        width: 100%;
        padding-right: 40px;
    }

    .toggle-password {
        position: absolute;
        right: 12px;
        top: 38px;
        cursor: pointer;
        font-size: 18px;
    }

    .error-text {
        box-sizing: border-box;
        color: #e11d48;
        font-size: 12px;
    }

    /* Main admin area */
    .admin-content {
        margin-left: 260px;
        /* sidebar width */
        padding: 100px 60px 40px;
        /* ⬅️ TOP padding for header */
        background: radial-gradient(circle at top left, #1a1a1d, #09090b);
        min-height: 100vh;
    }





    .page-header {
        margin-bottom: 30px;
        border-left: 4px solid #D4AF37;
        /* Primary Gold */
        padding-left: 20px;
    }

    .page-header h2 {
        font-family: 'Cinzel', serif;
        font-size: 28px;
        color: #D4AF37;
        margin-bottom: 8px;
        letter-spacing: 1px;
    }

    .page-header p {
        color: #A1A1AA;
        /* Muted text */
        font-size: 14px;
    }

    /* 2. Dark Glass-like Form Card */
    .form-card {
        background: #121214;
        padding: 40px;
        border-radius: 20px;
        border: 1px solid #27272A;
        /* Dark Border */
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4);
        /* Deep Shadow */
    }

    /* 3. Section Titles */
    .form-section-title {
        color: #FFFFFF;
        font-size: 16px;
        font-weight: 600;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 1px solid #27272A;
        letter-spacing: 0.5px;
        text-transform: uppercase;
    }

    /* 4. Grid Layout for Fields */
    .form-row {
        display: grid;
        grid-template-columns: 1fr;
        /* Two columns */
        gap: 30px;
        margin-bottom: 10px;
    }

    /* 5. Input Groups */
    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        color: #A1A1AA;
        font-size: 13px;
        margin-bottom: 8px;
        display: block;
        font-weight: 500;
    }

    /* 6. Creative Input Fields with Icons */
    .input-wrapper {
        position: relative;
        display: flex;
        align-items: center;
    }

    /* Icon style inside input */
    .input-wrapper i {
        position: absolute;
        left: 15px;
        color: #D4AF37;
        /* Gold Icon */
        font-size: 18px;
        pointer-events: none;
        transition: 0.3s;
    }

    /* The actual input field */
    .form-group input,
    .form-group select,
    .form-group textarea {
        width: 100%;
        padding: 14px 14px 14px 14px;
        /* Left padding space for the icon */
        background: rgba(255, 255, 255, 0.03);
        /* Slight transparency */
        border: 1px solid #27272A;
        border-radius: 10px;
        color: #FFFFFF;
        font-size: 14px;
        transition: all 0.3s;
        outline: none;
    }

    /* Hover & Focus Effects */
    .form-group input:hover,
    .form-group select:hover,
    .form-group textarea:hover {
        border-color: #555;
    }

    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
        border-color: #D4AF37;
        /* Gold Border on Click */
        background: rgba(212, 175, 55, 0.05);
        /* Soft Gold Tint */
        box-shadow: 0 0 0 4px rgba(212, 175, 55, 0.1);
        /* Glow Effect */
    }

    /* Placeholder color */
    .form-group input::placeholder {
        color: #555;
    }

    /* Dropdown Options (Fix for dark mode) */
    .form-group select option {
        background: #1a1a1d;
        color: #fff;
        padding: 10px;
    }

    /* 7. Save Button (Golden Gradient) */
    .save-btn {
        width: 100%;
        margin-top: 25px;
        padding: 16px;
        border-radius: 12px;
        border: none;
        font-size: 16px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #000;
        /* Black text on gold is best for contrast */
        cursor: pointer;
        background: linear-gradient(135deg, #D4AF37, #F3E5AB);
        /* Gold to Light Gold */
        transition: all 0.3s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        box-shadow: 0 5px 15px rgba(212, 175, 55, 0.15);
    }

    .save-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(212, 175, 55, 0.35);
        /* Stronger glow on hover */
        filter: brightness(1.1);
    }

    .save-btn:active {
        transform: translateY(-1px);
    }

    /* 8. Error Text */
    .error-text {
        color: #ff5b5b;
        /* Bright Red */
        font-size: 12px;
        margin-top: 6px;
        display: flex;
        align-items: center;
        gap: 5px;
        font-weight: 500;
    }

    /* 9. Mobile Responsiveness */
    @media(max-width: 768px) {
        .form-row {
            grid-template-columns: 1fr;
            /* Stack inputs on mobile */
            gap: 15px;
        }
    }
</style>

<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



<script>

    // Toggle Password Visibility
    $(".toggle-password").click(function () {

        let inputId = $(this).data("target");
        let input = $("#" + inputId);
        let icon = $(this).find("i");

        if (input.attr("type") === "password") {
            input.attr("type", "text");
            icon.removeClass("ri-eye-line").addClass("ri-eye-off-line");
        } else {
            input.attr("type", "password");
            icon.removeClass("ri-eye-off-line").addClass("ri-eye-line");
        }
    });

    // old and new password validation
    $.validator.addMethod("notEqualToOld", function (value, element) {
        return value !== $("#old_password").val();
    }, "New password must be different from old password");




    $("#changePasswordForm").validate({
        rules: {
            old_password: {
                required: true,
                minlength: 6,
                remote: {
                    url: "/check-old-password",
                    type: "GET",
                    data: {
                        old_password: function () {
                            return $("#old_password").val();
                        }
                    },
                    dataFilter: function (response) {
                        var json = JSON.parse(response);
                        if (json.valid) {
                            return true;
                        } else {
                            return false;
                        }
                    }
                }
            },
            new_password: {
                required: true,
                minlength: 6,
                notEqualToOld: true
            },
            confirm_password: {
                required: true,
                equalTo: "#new_password"
            }
        },
        messages: {
            old_password: {
                required: "Old password is required",
                minlength: "Minimum 6 characters",
                remote: "Old password is incorrect"
            },
            new_password: {
                required: "New password is required",
                minlength: "Minimum 6 characters"
            },
            confirm_password: {
                required: "Confirm password is required",
                equalTo: "Passwords do not match"
            }
        },
        errorElement: "small",
        errorClass: "error-text"
    });
</script>



{{-- SweetAlert Session Messages --}}
@if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: "{{ session('success') }}",
            confirmButtonColor: '#6366f1'
        }).then(() => {
            // Redirect to logout 
            window.location.href = "{{ route('admin.logout') }}";
        });
    </script>
@endif

@if(session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: "{{ session('error') }}",
            confirmButtonColor: '#e11d48'
        });
    </script>
@endif


</body>

</html>