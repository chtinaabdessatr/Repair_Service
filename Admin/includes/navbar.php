<?php
        $sql = "SELECT COUNT(*) as count FROM Repairs ";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
        // Assuming there is only one row returned
        $row = $result->fetch_assoc();
        $pics = $row["count"];
        } 
        $sql = "SELECT *  FROM `admin` WHERE aid = $tec_id";
              $result = $conn->query($sql);
              if($result->num_rows > 0){
                    $row = $result->fetch_assoc();
                    $aname = $row["aname"];
                }
        $sql = "SELECT count(*) as count FROM technicians";
        $result = $conn->query($sql);
            if($result->num_rows > 0){
                $row = $result->fetch_assoc();
                $count = $row["count"];
            }

?>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap");

        :root {
            --header-height: 3rem;
            --nav-width: 280px;
            --first-color: #4723D9;
            --first-color-light: #AFA5D9;
            --white-color: #F7F6FB;
            --body-font: 'Nunito', sans-serif;
            --normal-font-size: 1rem;
            --z-fixed: 100;
        }

        *,
        ::before,
        ::after {
            box-sizing: border-box;
        }

        body {
            position: relative;
            margin: var(--header-height) 0 0 0;
            padding: 0 1rem;
            font-family: var(--body-font);
            font-size: var(--normal-font-size);
            transition: .5s;
            padding-left: calc(var(--nav-width) + 1rem); /* Adjusted padding */
        }

        a {
            text-decoration: none;
        }

        .nav_info{
            color: var(--first-color);
            margin-left: 20px;
            margin-bottom: 20px;
            background-color: white;
            padding-inline: 20px;
            padding-block: 10px;
            border-radius: 20px;
            width: max-content;
            text-align: left;
        }
        
        .nav_list a{
            transition: .2s;
        }

        .nav_list a:hover{
            text-decoration: none;
            scale: 110%;
        }

        .l-navbar {
            position: fixed;
            top: 0;
            left: 0; /* Show by default */
            width: var(--nav-width);
            height: 100vh;
            background-color: var(--first-color);
            padding: .5rem 1rem 0 0;
            transition: .5s;
            z-index: var(--z-fixed);
            padding-top: 20px;
        }

        .nav {
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            overflow: hidden;
        }

        .nav_logo,
        .nav_link {
            display: grid;
            grid-template-columns: max-content max-content;
            align-items: center;
            column-gap: 1rem;
            padding: .5rem 0 .5rem 1.5rem;
        }

        .nav_logo {
            margin-bottom: 2rem;
        }

        .nav_logo-icon {
            font-size: 1.25rem;
            color: var(--white-color);
        }

        .nav_logo-name {
            color: var(--white-color);
            font-weight: 700;
        }

        .nav_link {
            position: relative;
            color: var(--first-color-light);
            margin-bottom: 1.5rem;
            transition: .3s;
        }

        .nav_link:hover {
            color: var(--white-color);
        }

        .nav_icon {
            font-size: 1.25rem;
        }

        .show {
            left: 0;
        }

        .body-pd {
            padding-left: calc(var(--nav-width) + 1rem);
        }

        .active {
            color: var(--white-color);
        }

        .active::before {
            content: '';
            position: absolute;
            left: 0;
            width: 2px;
            height: 32px;
            background-color: var(--white-color);
        }

        .height-100 {
            height: 100vh;
        }


    </style>

<h4>Admin : <?php echo $aname  ?></h4>
    <div class="l-navbar show" id="nav-bar"> <!-- Sidebar shown by default -->
        <nav class="nav">
            <div>
                <div class="nav_info">
                    <p><i class="ri-user-fill"> </i><strong> Name: </strong><?php echo htmlspecialchars($aname); ?></p>
                    <p><i class="ri-user-settings-fill"> </i><strong> Techecias: </strong><?php echo htmlspecialchars($count); ?></p>
                    <p><i class="ri-folder-settings-fill"> </i><strong> Repairs: </strong><?php echo htmlspecialchars($pics); ?></p>
                </div>
                <div class="nav_list">
                    <a href="./dashboard.php" class="nav_link">
                        <i class='bx bx-user nav_icon'></i>
                        <span class="nav_name">My Profile</span>
                    </a>
                    <a href="./add_tec.php" class="nav_link">
                        <i class='bx bx-user nav_icon'></i>
                        <span class="nav_name">Add Technician</span>
                    </a>
                    <a href="./admin_setting.php" class="nav_link">
                    <i class='bx bx-bookmark nav_icon'></i>
                        <span class="nav_name">Change PIN</span>
                    </a>
                    <a href="./orders.php" class="nav_link">
                        <i class='bx bx-folder nav_icon'></i>
                        <span class="nav_name">Ordered Materials</span>
                    </a>
                    <a href="./order_history.php" class="nav_link">
                        <i class='bx bx-log-out nav_icon'></i>
                        <span class="nav_name">Orders History</span>
                    </a>
                    <a href="./logout.php" class="nav_link">
                        <i class='bx bx-log-out nav_icon'></i>
                        <span class="nav_name">Logout</span>
                    </a>
                </div>
            </div>
        </nav>
    </div>

    <div class="container"> <!-- Added a container to wrap the content -->
    <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            const showNavbar = (toggleId, navId, bodyId, headerId) => {
                const toggle = document.getElementById(toggleId),
                    nav = document.getElementById(navId),
                    bodypd = document.getElementById(bodyId),
                    headerpd = document.getElementById(headerId);

                if (toggle && nav && bodypd && headerpd) {
                    toggle.addEventListener('click', () => {
                        nav.classList.toggle('show');
                        toggle.classList.toggle('bx-x');
                        bodypd.classList.toggle('body-pd');
                        headerpd.classList.toggle('body-pd');
                    });
                }
            };

            showNavbar('header-toggle', 'nav-bar', 'body-pd', 'header');

            const linkColor = document.querySelectorAll('.nav_link');

            function colorLink() {
                if (linkColor) {
                    linkColor.forEach(l => l.classList.remove('active'));
                    this.classList.add('active');
                }
            }
            linkColor.forEach(l => l.addEventListener('click', colorLink));
        });
    </script>