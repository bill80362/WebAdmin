<? include VIEW_PATH."/include/_header.php"; ?>

<style>
    .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    @media (min-width: 768px) {
        .bd-placeholder-img-lg {
            font-size: 3.5rem;
        }
    }
</style>

<body class="bg-light">

<? include VIEW_PATH."/include/_nav.php"; ?>

<!--<div class="nav-scroller bg-white shadow-sm">-->
<!--    <nav class="nav nav-underline">-->
<!--        <a class="nav-link active" href="#">我的帳戶</a>-->
<!--    </nav>-->
<!--</div>-->

<main role="main" class="container">

    <div class="my-3 p-3 bg-white rounded shadow-sm">
        <div class="row">
            <div class="col-md-12 order-md-1">
                <h4 class="mb-3">我的帳戶</h4>
                <hr class="mb-4">
                <form class="needs-validation" novalidate>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="firstName">帳號</label>
                            <input type="text" class="form-control" id="firstName" placeholder="" value="" required>
                            <div class="invalid-feedback">
                                Valid first name is required.
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="lastName">密碼</label>
                            <input type="text" class="form-control" id="lastName" placeholder="" value="" required>
                            <div class="invalid-feedback">
                                Valid last name is required.
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="username">姓名</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="username" required>
                            <div class="invalid-feedback" style="width: 100%;">
                                Your username is required.
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="username">電話</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="username" placeholder="0912345678" required>
                            <div class="invalid-feedback" style="width: 100%;">
                                Your username is required.
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="email">Email <span class="text-muted">(Optional)</span></label>
                        <input type="email" class="form-control" id="email" placeholder="you@example.com">
                        <div class="invalid-feedback">
                            Please enter a valid email address for shipping updates.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="address">地址</label>
                        <input type="text" class="form-control" id="address" placeholder="1234 Main St" required>
                        <div class="invalid-feedback">
                            Please enter your shipping address.
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="cc-expiration">推薦帳號</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">@</span>
                                </div>
                                <input type="text" class="form-control" id="cc-expiration" placeholder="" required>
                            </div>
                        </div>
                    </div>
                    <hr class="mb-4">
                    <button class="btn btn-primary btn-lg btn-block" type="submit">更新</button>
                </form>
            </div>
        </div>
    </div>

</main>

<? include VIEW_PATH."/include/_js_src.php"; ?>


<? include VIEW_PATH."/include/_footer.php"; ?>