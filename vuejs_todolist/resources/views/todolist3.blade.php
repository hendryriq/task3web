<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    {{-- jquery --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"
        integrity="sha512-bnIvzh6FU75ZKxp0GXLH9bewza/OIw6dLVh9ICg0gogclmYGguQJWl8U30WpbsGTqbIiAwxTsbe76DErLq5EDQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

    {{-- Vue --}}
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>

    {{-- Axios --}}
    <script src="https://cdn.jsdelivr.net/npm/axios@1.1.2/dist/axios.min.js"></script>


    <style>
        .todolist-wrapper {
            border: 1px solid #cccccc;
            min-height: 100px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="modal fade" id="modal-id">
            <div class="modal-content">
                <div class="modal-header">
                    < </div>
                </div>
            </div>
            <div class="" id="app">
                <div class="modal" id="modal-form">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <h5 class="modal-title">TodoList Form</h5>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="">Content</label>
                                    <textarea v-model="content" class="form-control" rows="10"></textarea>
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

                <div class="text-right mb-3">
                    <a href="javascript:;" @click="openForm" class="btn btn-primary">Tambah Todolist</a>
                </div>

                <div class="text-center mb-3">
                    <input type="text" v-model="search" placeholder="Cari disini" @change="findData" class="form-control">
                </div>

                <div class="row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-6">
                        <div class="todolist-wrapper">
                            <p>@(item.content)</p>
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

        <script>
            var vue = new vue({
                el: "#app",
                mounted() {
                    this.getDataList();
                },
                data: {
                    data_list: [],
                    content: "",
                    id: "",
                    search: ""


                },
                methods: {
                    findData: function(){
                        this.getDataList();
                    }
                    openForm: function() {
                        $('#modal-form').modal('show');

                    },
                    deleteData: function(id){
                        if(confirm('Apakah data ini akan dihapus')){
                            axios.post("{{ url('api/todolist/delete') }}/" + id)
                            .then(resp=>{
                                alert(resp.data.message);
                                this.getDataList();
                            })
                            .catch(err => {
                                alert("Terjadi kesalahan pada sistem!");
                            })
                        }
                    }
                    editData: function(id) {
                        this.id = id;

                        axios.get("{{ url('api/todolist/read') }}/" + this.id)
                            .then(resp => {
                                var item = resp.data;
                                this.content = item.content;

                                $('#modal-form').modal('show');
                            })
                            .catch(err => {
                                alert("Terjadi kesalahan pada sistem!");
                            })
                    },
                    saveTodoList: function() {
                        var form_data = new FormData();
                        form_data.append("content", this.content);

                        if (this.id) {
                            //Update data
                            axios.post("{{ url('api/todolist/update') }}/" + this.id, form_data)
                                .then(resp => {
                                    this.content = "";
                                    $('#modal-form').modal('hide');
                                    this.getDataList;
                                })
                                .catch(err => {
                                    alert("Terjadi kesalahan pada sistem" + err);
                                })

                        } else {
                            //create data
                            axios.post("{{ url('api/todolist/create') }}", form_data)
                                .then(resp => {
                                    this.content = "";
                                    $('#modal-form').modal('hide');
                                    this.getDataList;
                                })
                                .catch(err => {
                                    alert("Terjadi kesalahan pada sistem")
                                })

                        }


                    },
                    getDataList: function() {
                        axios.get("{{ url('api/todolist/list') }}?search=" + this.search)
                            .then(resp => {
                                data_list = resp.data
                            })
                        catch (err => {
                            alert("Terjadi kesalahan pada sistem")

                        })
                    }

                }
            })
        </script>

</body>

</html>
