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

<? include VIEW_PATH."/admin/order/_sub_nav.php"; ?>

<main role="main" class="container">

    <div class="p-3 bg-white rounded shadow-sm">
        <h6 class="pb-2 mb-0">搜尋條件</h6>
        <form class="needs-validation" novalidate>
            <div class="row">
                <div class="col-md-3 mb-3">
                    <input type="text" class="form-control" id="firstName" placeholder="購買會員帳號" value="" required>
                </div>
                <div class="col-md-3 mb-3">
                    <select id="inputState" class="form-control">
                        <option selected>帳號排序</option>
                        <option>創建帳號日期</option>
                        <option>創建帳號日期(反向)</option>
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <button class="btn btn-primary btn-block" type="submit">搜尋</button>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 mb-3">
                    (開始)<input type="date" class="form-control" id="date_start" value="2020-06-04" required>
                </div>
                <div class="col-md-3 mb-3">
                    (結束)<input type="date" class="form-control" id="date_end" value="2020-06-04" required>
                </div>
            </div>

        </form>

            <h6 class="border-bottom border-gray pb-2 mb-0">會員列表</h6>
            <div class="media text-muted pt-3">
                <table class="table table-striped ">
                    <thead class="table-primary">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">名稱</th>
                            <th scope="col">帳號</th>
                            <th scope="col">電話</th>
                            <th scope="col">Email</th>
                            <th scope="col">介紹人</th>
                            <th scope="col">訂購日期</th>
                        </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>陳大尾</td>
                        <td>Bill</td>
                        <td>0912-345678</td>
                        <td>bill@gmail.com</td>
                        <td>Gate</td>
                        <td>2020-06-24</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>陳中尾</td>
                        <td>Andy</td>
                        <td>0912-345678</td>
                        <td>bill@gmail.com</td>
                        <td>Gate</td>
                        <td>2020-06-24</td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>陳小尾</td>
                        <td>Bird</td>
                        <td>0912-345678</td>
                        <td>bill@gmail.com</td>
                        <td>Gate</td>
                        <td>2020-06-24</td>
                    </tr>
                    </tbody>
                </table>
            </div>

    </div>
</main>

<? include VIEW_PATH."/include/_js_src.php"; ?>


<? include VIEW_PATH."/include/_footer.php"; ?>