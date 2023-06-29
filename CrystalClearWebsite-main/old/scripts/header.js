let appHeader = `
    <!-- Header Menu of the Page -->

    <header>
        <!-- Top header menu containing
            logo and Navigation bar -->
        <div id="top-header">

            <!-- Navigation Bar -->
            <nav id="nav-bar">
                <!-- Logo -->
                <div class="logo">
                    <a href="#Home">
                        <div class="overlay"></div>
                    </a>
                </div>

                <img src="../images/sun.png" id="contrastToggle" onclick="contrastToggle();" />

                <input id="collapseMenu" class="toggle" type="checkbox">
                <label for="collapseMenu" class="menu-toggle">Menu</label>

                <div id="nav-menu">
                

                    <ul>
                        <li class="nav-item"><a href="#">Home</a></li>
                        <li class="nav-item"><a href="../pages/services.html">Estimates</a></li>
                        <li class="nav-item"><a href="#">Contact Us</a></li>
                        <li class="nav-item"><a href="../pages/login.html">Login</a></li>
                    </ul>

                </div>
            </nav>


        </div>

        <!-- Image menu in Header to contain an Image and
            a sample text over that image -->
        <div id="header-image-menu">

        </div>
    </header>
`;
document.getElementById("app-header").innerHTML = appHeader;