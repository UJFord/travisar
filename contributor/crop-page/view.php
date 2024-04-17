<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Banay-Banay</title>
    <!-- bootstrap cdn -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        .nav-link.active {
            color: #f5f5f5 !important;
            background: #016A70 !important;
            /* Change 'green' to your desired success color */
        }
    </style>

</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-2">
                <nav id="navbar" class="h-100 flex-column align-items-stretch pe-4 border-end">
                    <nav class="nav nav-pills flex-column sticky-top pt-5">
                        <a class="nav-link text-dark fw-semibold" href="#general">General</a>
                        <nav class="nav nav-pills flex-column">
                            <a class="nav-link ms-3 my-1" href="#item-1-1">General Information</a>
                            <a class="nav-link ms-3 my-1" href="#item-1-2">Item 1-2</a>
                        </nav>
                    </nav>
                </nav>
            </div>

            <div class="col pt-5">
                <div data-bs-spy="scroll" data-bs-target="#navbar-example3" data-bs-smooth-scroll="true" class="scrollspy-example-2" tabindex="0">

                    <div id="item-1">
                        <h4>Item 1</h4>
                        <p>. Lorem ipsum dolor sit amet consectetur adipisicing elit. Explicabo aliquam placeat atque blanditiis ipsam doloremque! Harum sapiente a commodi maiores quisquam fugit perspiciatis veritatis temporibus. Dolore repellat saepe dolor iure reprehenderit tempora sed nostrum temporibus vel. Ut voluptas omnis dolorum error natus corrupti nihil deleniti molestias explicabo laborum quis cumque, eveniet cupiditate quibusdam adipisci! Tempore corrupti dolorem ex sint, minima rem itaque nobis autem obcaecati, quas quia sequi unde asperiores architecto ipsum earum consequatur doloremque repudiandae non recusandae? Error quo illo quae? Accusamus, error aliquam facere, laudantium eligendi expedita aperiam nobis libero praesentium rem quasi soluta amet quod quam vitae!..</p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- bootstrap script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>