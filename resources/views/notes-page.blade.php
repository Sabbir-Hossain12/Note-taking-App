@extends('layouts.home')

@section('contents')
    <div class="container-fluid">
        <div class="row">


            <main class="col-md-12 ms-sm-auto col-lg-12 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Note List</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group me-2">
                       <a href="{{route('notes.create')}}">    <button type="button" class="btn btn-dark btn-outline-secondary text-light">Create Notes</button></a>

                        </div>

                    </div>
                </div>


{{--                <h2>Section title</h2>--}}
                <div class="table-responsive">
                    <table class="table table-striped table-sm table-bordered" id="tableData">
                        <thead>
                        <tr>
                            <th scope="col">SN</th>
                            <th scope="col">title</th>
                            <th scope="col">content</th>
                            <th scope="col">Creation</th>
                            <th scope="col">Last Modified</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody id="tableList">


                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>


{{--  Update Modal  --}}
    <div class="modal animated zoomIn" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Notes</h5>
                </div>
                <div class="modal-body">
                    <form id="update-form">
                        <div class="container">
                            <div class="row">
                                <div class="col-12 p-1">


                                    <label for="nTitle" class="form-label">title</label>
                                    <input type="text" class="form-control" id="nTitle">

                                    <label for="nContent" class="form-label mt-2">Email</label>
                                    <textarea  class="form-control" id="nContent"></textarea>

                                    <input type="text" class="d-none" id="updateID">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button id="update-modal-close" class="btn btn-outline-warning" data-bs-dismiss="modal"
                            aria-label="Close">Close
                    </button>
                    <button onclick="updateNote()" id="update-btn" class="btn btn-outline-primary">Update</button>
                </div>

            </div>
        </div>
    </div>


    {{--  Delete Modal  --}}

    <div class="modal animated zoomIn" id="delete-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <h3 class=" mt-3 text-warning">Delete !</h3>
                    <p class="mb-3">Once delete, you can't get it back.</p>
                    <input class="d-none" id="deleteID"/>
                </div>
                <div class="modal-footer justify-content-end">
                    <div>
                        <button type="button" id="delete-modal-close" class="btn btn-outline-warning mx-2" data-bs-dismiss="modal">Cancel</button>
                        <button onclick="noteDelete()" type="button" id="confirmDelete" class="btn btn-outline-danger" >Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        (async () => {
            await noteList();
        })();

        async function noteList() {

            await axios.get('/notes')
                .then(function (response) {
                    let jobList=response.data['data']
                    // Destroy existing DataTable instance
                    $('#tableData').DataTable().destroy();
                    // Handle the successful response
                    $('#tableList').empty();
                    jobList.forEach(function (item, i) {
                        let foreach = ` <tr class="odd">
                                            <td >${i + 1}</td>
                                            <td >${item['title']}</td>
                                            <td>${item['content']}</td>
                                            <td>${item['formatted_created_at']}</td>
                                            <td>${item['formatted_modified_at']}</td>

                                            <td><div class="d-flex gap-2">
                                               <button data-id=${item['id']} class="btn btn-lg editbtn"><i class="fas fa-edit"></i></button>
                                            <button data-id=${item['id']} class="btn  deletebtn btn-lg"><i class="fas fa-trash-alt"></i></button>

                                            </div></td>

                                                </tr>`

                        $('#tableList').append(foreach)


                    })

                    $('.editbtn').on('click', async function () {
                        let id = $(this).data('id');
                        $('#updateID').val(id);
                        $('#update-modal').modal('show');

                        await fillNoteData()

                    })

                    $('.deletebtn').on('click', async function () {
                        let id = $(this).data('id');
                        $('#deleteID').val(id);
                        $('#delete-modal').modal('show');


                    })


                    $('#tableData').dataTable({
                        order: [[0, 'asc']],
                        pagingType: 'numbers'
                    });
                })
                .catch(function (error) {
                    // Handle errors
                    console.error('Error:', error);
                });


        }


       async function noteDelete()
        {
            let  id = $('#deleteID').val();
                try {
                        let res= await axios.delete(`/notes/${id}`);

                        if (res.data.message === 'success') {
                            successToast('Note Deleted')
                            $('#delete-modal').modal('hide');
                            await noteList();

                        }
                        else
                        {
                            errorToast('Something Went Wrong')
                        }
                }
                catch (e)
                {
                    console.log(e.message)
                }
        }

       async function fillNoteData()
       {
           let id=$('#updateID').val();
           try {
               let res= await axios.get(`/notes/${id}`)

               if (res.data.message==='success')
               {
                   $('#nTitle').val(res.data.data['title']);
                   $('#nContent').val(res.data.data['content']);
               }
               else
               {
                   errorToast('something went wrong')
               }
           }
           catch (e)
           {

           }
       }
       async function updateNote()
       {
           let id=$('#updateID').val();
           let title=$('#nTitle').val();
           let content=$('#nContent').val();

           try {
               let res= await axios.put(`/notes/${id}`,{'title': title, 'content': content})

               if (res.data.message==='success')
               {
                   successToast('Note Updated')
                   $('#update-modal').modal('hide');
                   await noteList();
               }
               else
               {
                   errorToast('something went wrong')
               }
           }
           catch (e)
           {

           }
       }
    </script>
@endsection
