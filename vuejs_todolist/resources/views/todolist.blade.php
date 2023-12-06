<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    {{--  JQuery  --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"
        integrity="sha512-bnIvzh6FU75ZKxp0GXLH9bewza/OIw6dLVh9ICg0gogclmYGguQJWl8U30WpbsGTqbIiAwxTsbe76DErLq5EDQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    {{--  Axios  --}}
    <script src="https://cdn.jsdelivr.net/npm/axios@1.1.2/dist/axios.min.js"></script>

    {{--  Font Awesome  --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{--  Bootstrap  --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    {{--  Vue JS  --}}
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>

    <style>
        .todolist-wrapper {
            border: 1px solid #cccccc;
            min-height: 100px;
        }
    </style>
</head>

<body>


    <div class="container">
        <div id="app">

            <!-- Modal -->
            <div class="modal" id="modalForm">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h5 class="modal-title">Todo List Form</h5>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="">Content</label>
                                <textarea v-model="content" class="form-control" rows="5"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" @click="saveTodoList" class="btn btn-primary">Save
                                Todolist</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-3"></div>

                <div class="col-sm-6">
                    <div class="text-right mb-3">
                        <a href="javascript:;" @click="openForm" class="btn btn-primary">Tambah Todolist</a>
                    </div>

                    <div class="text-center mb-3">
                        <input type="text" v-model="search" @change="findData" placeholder="Cari disini ..."
                            class="form-control">
                    </div>

                    <div class="todolist-wrapper">
                        <table class="table table-striped table-bordered">
                            <tbody>
                                <tr v-for="item in data_list">
                                    <td>@{{ item.content }}
                                        <a href="javascript:;" @click="editData(item.id)"
                                            class="btn btn-primary">Edit</a>
                                        <a href="javascript:;" @click="deleteData(item.id)"
                                            class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                                <tr v-if="!data_list.length">
                                    <td>Data masih kosong</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="col-sm-3"></div>
            </div>
        </div>
    </div>

    {{--  JQuery  --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    {{--  Bootstrap  --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

    <script>
        var vue = new Vue({
            el: "#app",
            mounted() {
                this.getDataList();
            },
            data: {
                data_list: [],
                content: "",
                id: '',
                search: ""
            },
            methods: {
                openForm: function() {
                    $('#modalForm').modal('show');
                },

                findData: function() {
                    this.getDataList();
                },

                saveTodoList: function() {
                    var form_data = new FormData();
                    form_data.append("content", this.content);

                    if (this.id) {
                        axios.post("{{ url('api/todolist/update') }}/" + this.id, form_data)
                            .then(res => {
                                this.content = "";
                                alert(res.data.message);
                                $('#modalForm').modal('hide');
                                this.getDataList();
                            })
                            .catch(err => {
                                alert("Terjadi kesalahan pada sistem" + err);
                            })
                    } else {
                        axios.post("{{ url('api/todolist/create') }}", form_data)
                            .then(res => {
                                this.content = "";
                                alert(res.data.message);
                                $('#modalForm').modal('hide');
                                this.getDataList();
                            })
                            .catch(err => {
                                alert("Terjadi kesalahan pada sistem" + err);
                            })
                            .finally(() => {
                                $('#modalForm').modal('hide');
                            })
                    }
                },

                getDataList: function() {
                    axios.get("{{ url('api/todolist/list') }}?search=" + this.search)
                        .then(response => {
                            this.data_list = response.data;
                        })
                        .catch(error => {
                            alert("Terjadi kesalahan pada sistem" + error);
                        });
                },

                editData: function(id) {
                    this.id = id;
                    axios.get("{{ url('api/todolist/read') }}/" + this.id)
                        .then(res => {
                            var item = res.data;
                            this.content = item.content;
                            $('#modalForm').modal('show')

                        })
                        .catch(err => {
                            alert("Terjadi Kesalahan Pada Sistem");
                        });

                },

                deleteData: function(id) {
                    if (confirm("Apakah anda ingin menghapus?")) {
                        axios.post("{{ url('api/todolist/delete') }}/" + id)
                            .then(res => {
                                alert(res.data.message);
                                this.getDataList();
                            })
                            .catch(err => {
                                alert("Terjadi kesalahan" + err);
                            });
                    }
                },
            },
        })
    </script>
</body>

</html>