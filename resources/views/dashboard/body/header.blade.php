<nav class="topnav navbar navbar-expand shadow justify-content-between justify-content-sm-start navbar-light bg-white"
     id="sidenavAccordion">
    <!-- Sidenav Toggle Button-->
    <button class="btn btn-icon btn-transparent-dark order-1 order-lg-0 me-2 ms-lg-2 me-lg-0" id="sidebarToggle"><i
            data-feather="menu"></i></button>
    <!-- Navbar Brand-->
    <!-- * * Tip * * You can use text or an image for your navbar brand.-->
    <!-- * * * * * * When using an image, we recommend the SVG format.-->
    <!-- * * * * * * Dimensions: Maximum height: 32px, maximum width: 240px-->
    <a class="navbar-brand pe-3 ps-4 ps-lg-2" href="{{ route('dashboard') }}">Stok Manajemen</a>
    <!-- Navbar Search Input-->
    <!-- * * Note: * * Visible only on and above the lg breakpoint-->
    <form class="form-inline me-auto d-none d-lg-block me-3">
        <div class="input-group input-group-joined input-group-solid">
            <input class="form-control pe-0" type="search" placeholder="Search" aria-label="Search"/>
            <div class="input-group-text"><i data-feather="search"></i></div>
        </div>
    </form>

    <!-- Navbar Items-->
    <ul class="navbar-nav align-items-center ms-auto">
        <!-- User Profile Image with Notification Icon -->
        <li class="nav-item mx-5">
            <div class="dropdown">
                <a class="btn btn-icon btn-transparent-dark dropdown-toggle" href="#" role="button"
                   id="notificationsDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="notification-icon">
                            <i class="fa fa-bell"></i>
                        </span>

                    <span class="badge bg-danger position-absolute mt-1 top-0 start-100 translate-middle pulse-badge">
                        <span id="notificationCount">0</span>
                        <span class="visually-hidden">unread messages</span>
                    </span>
                    <!-- User Profile Image (for demonstration) -->
                    {{--                                    <img class="img-fluid user-profile-image" src="https://via.placeholder.com/40" />--}}
                </a>
                <div class="dropdown-menu dropdown-menu-end border-0 shadow animated--fade-in-up"
                     aria-labelledby="notificationsDropdown">
                    <div class="dropdown-header">Notifications</div>
                    <div id="notification-list">
                        <!-- Notifications will be displayed here -->\
                    </div>
                </div>
            </div>
        </li>


        <!-- User Dropdown-->
        <li class="nav-item dropdown no-caret dropdown-user me-3 me-lg-4">
            <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownUserImage"
               href="javascript:void(0);" role="button" data-bs-toggle="dropdown" aria-haspopup="true"
               aria-expanded="false">
                <img class="img-fluid"
                     src="{{ auth()->user()->photo ? asset('storage/profile/'.auth()->user()->photo) : asset('assets/img/illustrations/profiles/profile-1.png') }}"/></a>
            <div class="dropdown-menu dropdown-menu-end border-0 shadow animated--fade-in-up"
                 aria-labelledby="navbarDropdownUserImage">
                <h6 class="dropdown-header d-flex align-items-center">
                    <img class="dropdown-user-img"
                         src="{{ auth()->user()->photo ? asset('storage/profile/'.auth()->user()->photo) : asset('assets/img/illustrations/profiles/profile-1.png') }}"/>
                    <div class="dropdown-user-details">
                        <div class="dropdown-user-details-name">{{ auth()->user()->name }}</div>
                        <div class="dropdown-user-details-email">{{ auth()->user()->email }}</a></div>
                    </div>
                </h6>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('profile.edit') }}">
                    <div class="dropdown-item-icon"><i data-feather="settings"></i></div>
                    Account
                </a>

                <!-- Logout -->
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="dropdown-item" action="{{ route('logout') }}" method="POST"
                            onclick="return confirm('Are you sure you want to logout?')">
                        <div class="dropdown-item-icon"><i data-feather="log-out"></i></div>
                        Keluar
                    </button>
                </form>
            </div>
        </li>
    </ul>
</nav>


<!-- Activate Bootstrap tooltips and popovers -->
<script>
    // Function to fetch low stock products and due date purchases
    function fetchNotifications() {
        return fetch('/getNotifications')
            .then(response => response.json())
            .then(data => {
                console.log(data); // Log the response data
                return data.notifications;
            })
            .catch(error => {
                console.error('Error fetching notifications:', error);
                return [];
            });
    }

    // Function to update the notifications in the dropdown
    function updateNotifications() {
        const notificationList = document.getElementById('notification-list');
        notificationList.innerHTML = '';

        fetchNotifications()
            .then(notifications => {
                if (notifications.length > 0) {
                    notifications.forEach(notification => {
                        const notificationItem = document.createElement('div');
                        notificationItem.classList.add('dropdown-item');

                        if ('product_name' in notification) {
                            notificationItem.innerHTML = `
                        <strong>${notification.product_name}</strong> is low on stock. Current stock: ${notification.stock}
                    `;
                        } else if ('purchase_due_date' in notification) {
                            // Format the due date using toLocaleDateString
                            const formattedDueDate = new Date(notification.purchase_due_date).toLocaleDateString();

                            notificationItem.innerHTML = `
                        Batas Pembayaran Pembelian Barang Sudah Jatuh Tempo Pada: ${formattedDueDate}
                    `;
                        }

                        notificationList.appendChild(notificationItem);
                    });
                } else {
                    const noNotificationItem = document.createElement('div');
                    noNotificationItem.classList.add('dropdown-item', 'text-center', 'text-muted');
                    noNotificationItem.innerText = 'No notifications';
                    notificationList.appendChild(noNotificationItem);
                }

                const notificationCount = document.getElementById('notificationCount');
                notificationCount.innerText = notifications.length;
            });
    }

    // Call updateNotifications to show notifications on page load
    updateNotifications();

    // Event listener to update notifications when the dropdown is shown
    document.getElementById('notificationsDropdown').addEventListener('click', () => {
        updateNotifications();
    });

</script>
