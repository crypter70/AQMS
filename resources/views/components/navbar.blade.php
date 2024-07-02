<!-- resources/views/components/navbar.blade.php -->

<style>
    .navbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 20px;
    }

    .nav-icon {
        position: relative;
        display: inline-block;
        padding: 10px;
        vertical-align: middle;
    }

    .nav-icon i,
    .nav-icon img {
        font-size: 24px;
        width: 24px;
        height: 24px;
        vertical-align: middle;
    }

    .notification-badge {
        position: absolute;
        top: -5px;
        right: -5px;
        background-color: red;
        color: white;
        border-radius: 50%;
        padding: 2px 6px;
        font-size: 12px;
        z-index: 2;
    }

    .dropdown-menu {
        width: 350px;
    }

    .dropdown-header {
        font-weight: bold;
    }

    .dropdown-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .message {
        font-size: 14px;
        color: #333;
    }

    .timestamp {
        font-size: 12px;
        color: #999;
    }

    .dropdown-footer a {
        display: block;
        text-align: center;
        padding: 10px;
        background-color: #f8f9fa;
        color: #007bff;
        text-decoration: none;
    }

    .dropdown-footer a:hover {
        background-color: #e9ecef;
    }
</style>

<nav class="mb-70 navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="/">
            <img src="images/logo.png" height="80" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" aria-current="page" href="/">Overview</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('airmap') ? 'active' : '' }}" href="/airmap">Air Maps</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('breathecare') ? 'active' : '' }}" href="/breathecare">Breathe Care</a>
                </li>
            </ul>
            <!-- <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search from here..." aria-label="Search">
            </form> -->
            <div class="nav-icons ms-auto">
                <div class="dropdown">
                    <a href="#" class="nav-icon" id="dropdownNotification" data-bs-toggle="dropdown" aria-expanded="false">
                        <i id="bell-icon" class="fas fa-bell"></i>

                        <img id="active-icon" src="images/notif-fill.png" alt="Active Notification" style="display: none;">
                        <span class="notification-badge">3</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownNotification">
                        <li>
                            <h6 class="dropdown-header">Notifications</h6>
                        </li>
                        <li><a class="dropdown-item" href="#">
                                <div>
                                    <div class="message">Warning: You are in a hazardous zone!</div>
                                    <div class="timestamp">2 minutes ago</div>
                                </div>
                            </a></li>
                        <li><a class="dropdown-item" href="#">

                                <div>
                                    <div class="message">Alert: Poor air quality detected.</div>
                                    <div class="timestamp">10 minutes ago</div>
                                </div>
                            </a></li>
                        <li><a class="dropdown-item" href="#">

                                <div>
                                    <div class="message">Suggestion: Wear a mask when going outside.</div>
                                    <div class="timestamp">30 minutes ago</div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <div class="dropdown-footer"><a href="/notification">View all notifications</a></div>
                        </li>
                    </ul>
                </div>

                <a href="/faq" class="nav-icon {{ Request::is('faq') ? 'active' : '' }}">
                    @if(Request::is('faq'))
                    <img src="images/info-fill.png" alt="FAQ Icon">
                    @else
                    <i class="fa-solid fa-circle-question"></i>
                    @endif
                </a>
            </div>
        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var dropdownNotification = document.getElementById('dropdownNotification');
        var notificationBadge = document.getElementById('notification-badge');
        var bellIcon = document.getElementById('bell-icon');
        var activeIcon = document.getElementById('active-icon');

        // s
        function toggleNotifications() {
            const notifications = document.querySelector('.notifications');
            notifications.classList.toggle('active');

            if (notifications.classList.contains('active')) {
                const badge = document.querySelector('.notification-bell .badge');
                badge.textContent = '0';
            }
        }

        dropdownNotification.addEventListener('click', function() {
            notificationBadge.style.display = 'none';


            bellIcon.style.display = 'none';
            activeIcon.style.display = 'block';
        });
    });
</script>