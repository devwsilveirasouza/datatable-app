<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- Scripts Datatable --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.2.4/css/fixedHeader.dataTables.min.css">

    <title>Datatable</title>

    <style>
        /* Ajuste datatable */
        table {
            width: 900px;
            height: 300px;
        }
        table th {
            background-color: #41b3ff;
            color: white;
        }
    </style>

</head>
<body>

    <h3>Datatable com Search Column</h3>

    <table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Cadastro</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->created_at}}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Cadastro</th>
            </tr>
        </tfoot>
    </table>

    <script src="https://code.jquery.com/jquery-3.6.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.2.4/js/dataTables.fixedHeader.min.js"></script>

    <script>
        $(document).ready(function () {
            var table = $('#example').DataTable({
                orderCellsTop: true,
                fixedHeader: true
            });
            // Inserir uma nova linha no cabeçalho do datatable
            $('#example thead tr').clone(true).appendTo('#example thead');

            $('#example thead tr:eq(1) th').each(function (i) {
                var title = $(this).text();
                $(this).html('<input type="text" placeholder="Buscar..." />');

                $('input', this).on('keyup change', function () {
                    if (table.column(i).search() !== this.value) {
                        table
                            .column(i)
                            .search(this.value)
                            .draw();
                    }
                });
            });
        });

    </script>

</body>
</html>
