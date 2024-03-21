@extends('layouts.home')

@section('contents')

    <div class="container-fluid pt-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Create Notes</h4>
                        <p class="card-title-desc"></p>
                    </div>
                    <div class="card-body p-4">

                        <div class="row">
                            <div class="col-lg-6">
                                <div>
                                    <div class="mb-3">
                                        <label for="nTitle" class="form-label">Note Title</label>
                                        <input class="form-control" type="text" placeholder="EX: Work"
                                               id="nTitle">
                                    </div>

                                    <div class="mb-3">
                                        <label for="nContent" class="form-label">Content</label>
                                        <textarea class="form-control"
                                                  id="nContent" placeholder="Ex: Work for 8 hours"></textarea>
                                    </div>


                                </div>
                            </div>


                            <div>
                                <button onclick="noteSubmit()" type="submit" id="submit"
                                        class="text-center btn btn-primary">
                                    Save Note
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div>
    <script>
        async function noteSubmit() {


            let title = $('#nTitle').val();
            let content = $('#nContent').val();


            let obj = {


            }

            if (title.length === 0) {

                errorToast('Title  is Required !')
            }
            if (content.length === 0) {

                errorToast('Content is Required !')
            } else {
                try {
                    let res = await axios.post(`/notes`,{'title': title,
                        'content': content});
                    if (res.data.message === 'success') {
                        successToast('Note Saved')
                    } else {
                        errorToast(res.data.message)
                    }
                } catch (e) {
                    errorToast(e.message)

                }

            }
        }

    </script>
@endsection
