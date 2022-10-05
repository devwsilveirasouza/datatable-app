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
            padding: 20px;
            border-radius: 10%;
        }

        table th {
            background-color: #41b3ff;
            color: white;
        }
    </style>

</head>

<body>

    <h2 style="text-align: center;">Datatable com Input Select by Column</h2>

    <table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name </th>
                <th>Email</th>
                <th>Cadastro</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ date('d/m/Y', strtotime($user->created_at)) }}</td>
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
        $(document).ready(function() {
            $('#example').DataTable({
                initComplete: function() {
                    this.api()
                        .columns([1,3]) // Colunas a serem exibidas
                        .every(function() {
                            var column = this;
                            var select = $('<select><option value=""></option></select>')
                                .appendTo($(column.header())) // Mostra no cabeçalho o filtro e mantem o titulo
                                // .appendTo($(column.footer()).empty())
                                .on('change', function() {
                                    var val = $.fn.dataTable.util.escapeRegex($(this).val());

                                    column.search(val ? '^' + val + '$' : '', true, false)
                                        .draw();
                                });

                            column.data().unique().sort().each(function(d, j) {
                                if (column.search() === '^' + d + '$') {
                                    select.append('<option value="' + d +
                                        '" selected="selected">' + d + '</option>')
                                } else {
                                    select.append('<option value="' + d + '">' + d +
                                        '</option>')
                                }
                            });
                        });
                },
            });
        });
    </script>

</body>

</html>
