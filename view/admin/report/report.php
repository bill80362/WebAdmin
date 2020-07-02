<? include VIEW_PATH."/include/_header.php"; ?>

<link rel="stylesheet" href="/css/bootstrap-table.min.css">
<link rel="stylesheet" href="/css/all.min.css">

<body class="bg-light">

<? include VIEW_PATH."/include/_nav.php"; ?>

<? include VIEW_PATH."/admin/report/_sub_nav.php"; ?>

<main role="main" class="container-fluid">

    <div class="p-3 bg-white rounded shadow-sm">
        <h6 class="pb-2 mb-0">搜尋條件</h6>
        <form class="needs-validation" novalidate>
            <div class="row">
                <div class="col-md-3 mb-3">
                    <input type="text" class="form-control" id="firstName" placeholder="會員帳號" value="" required>
                </div>
                <div class="col-md-3 mb-3">
                    <button class="btn btn-primary btn-block" type="submit">搜尋</button>
                </div>
            </div>
        </form>


        <h5 class="pb-2 mb-0">報表</h5>
        <table id="table" class="table table-striped"
               data-show-export="true"
               data-show-columns="true"
               data-search="true"
               data-mobile-responsive="true"
               data-check-on-init="true"
            >
            <thead class="table-dark">
                <tr>
                    <th data-field="date" data-sortable="true">日期</th>
                    <th data-field="name" data-sortable="true">帳號</th>
                    <th data-field="price" data-sortable="true">Bonus</th>
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
        url:'/report/data',
        method: 'post',
        queryParams:obj,
    })

</script>

<? include VIEW_PATH."/include/_footer.php"; ?>