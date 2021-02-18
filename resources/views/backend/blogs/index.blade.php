@extends('backend.layout')
@section('content')
    <section class="content-header">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Blogs</h3>
                <div align="right">
                    <a href="{{route('blog.create')}}"><button class="btn btn-success">Ekle</button></a>
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Başlık</th>
                            <th></th>
                            <th></th>
                        </tr>
                        <tbody id="sortable">
                            @foreach($data['blog'] as $key)
                            <tr id="item-{{$key->id}}">
                                <td class="sortable">{{$key['blog_title']}}</td>
                                <td width="5"><a href="{{route('blog.edit',$key->id)}}"><i class="fa fa-pencil-square"></i></a></td>
                                <td width="5"><a href="javascript:void(0)"><i id="@php echo $key->id @endphp" class="fa fa-trash-o"></i></a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </thead>
                </table>  
            </div>
        </div>
    </section>

    <script type="text/javascript">
        $(function() {

            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#sortable').sortable({
                revert:true,
                handle:".sortable",
                stop:function(event,ui) {
                    var data=$(this).sortable('serialize');
                    $.ajax({
                        type:"POST",
                        data:data,
                        url:"{{route('blog.Sortable')}}",
                        success:function(msg) {
                            console.log(msg);
                            if(msg) {
                                alertify.success('İşlem Başarılı');
                            }
                            else {
                                alertify.error('İşlem Başarısız');
                            }
                        }
                    });
                }
            });
            $('#sortable').disableSelection();
        });

        $(".fa-trash-o").click(function() {
            let destroy_id=$(this).attr('id');

            alertify.confirm('Silme işlemini onaylayın!','Bu işlem geri alınamaz',
                function() {
                    $.ajax({
                        type: 'DELETE',
                        url: "blog/" + destroy_id,
                        success: function(result) {
                            if(result) { 
                                $("#item-"+destroy_id).remove();
                                alertify.success('Silme İşlemi Başarılı');
                            }
                            else {
                                alertify.error('İşlem Tamamlanamadı');
                            } 
                        },
                        error: function(error) {
                           alertify.error("Hata Oluştu. Lütfen Daha Sonra Tekrar Deneyiniz");
                        }
                    });
                },
                function() {
                    alertify.error('Silme işlemi iptal edildi');
                }
            );
        });
    </script>
@endsection

@section('css') 
@endsection

@section('js')
@endsection