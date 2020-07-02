<? include VIEW_PATH."/include/_header.php"; ?>

<link rel="stylesheet" href="/css/bootstrap-table.min.css">
<link rel="stylesheet" href="/css/all.min.css">

<body class="bg-light">

<? include VIEW_PATH."/include/_nav.php"; ?>

<? include VIEW_PATH."/admin/order/_sub_nav.php"; ?>

<main role="main" class="container-fluid">

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

        <h5 class="pb-2 mb-0">訂購列表</h5>
        <table id="table" class="table table-striped"
               data-show-export="true"
               data-show-columns="true"
               data-search="true"
               data-mobile-responsive="true"
               data-check-on-init="true"
        >
            <thead class="table-dark">
            <tr>
                <th data-field="id" data-sortable="true">ID</th>
                <th data-field="name" data-sortable="true">名稱</th>
                <th data-field="account" data-sortable="true">帳號</th>
                <th data-field="phone" data-sortable="true">電話</th>
                <th data-field="email" data-sortable="true">Email</th>
                <th data-field="intro" data-sortable="true">介紹人</th>
                <th data-field="new_time" data-sortable="true">訂購日期</th>
                <th data-field="price" data-sortable="true">總金額</th>
                <th data-field="order_data" data-sortable="true">訂購商品</th>
            </tr>
            </thead>
        </table>

    </div>
</main>

<? include VIEW_PATH."/include/_js_src.php"; ?>

<script src="/js/bootstrap-table.min.js"></script>
<script src="/js/tableExport.min.js"></script>
<script src="/js/bootstrap-table-export.min.js"></script>

<script>
    //要傳遞的參數json
    var obj = { name: "John", age: 30, city: "New York" };

    $('#table').bootstrapTable({
        exportTypes: ['csv', 'txt', 'excel'],
        url:'/order/data',
        method: 'post',
        queryParams:obj,
    })

</script>

<? include VIEW_PATH."/include/_footer.php"; ?>