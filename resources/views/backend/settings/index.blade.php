@extends('backend.layout')
@section('content')
    <section class="content-header">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Settings</h3>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Açıklama</th>
                            <th>İçerik</th>
                            <th>Anahtar Değer</th>
                            <th>Type</th>
                            <th></th>
                            <th></th>
                        </tr>
                        <tbody id="sortable">
                            @foreach($data['adminSettings'] as $key)
                            <tr id="item-{{$key->id}}">
                                <td>{{$key->id}}</td>
                                <td class="sortable">{{$key['settings_description']}}</td>
                                <td>
                                    @if($key->settings_type=="file")
                                        <img width="100" height="120" src="/images/settings/{{$key->settings_value}}"/>
                                    @else
                                        {{$key->settings_value}}    
                                    @endif
                                </td>
                                <td>{{$key->settings_key}}</td>
                                <td>{{$key->settings_type}}</td>
                                <td><a href="{{route('settings.Edit',['id'=>$key->id])}}"><i id="{{$key->id}}" class="fa fa-pencil-square"></i></a></td>
                                <td>
                                    @if($key->settings_delete)
                                        <a href="javascript:void(0)"><i id="@php echo $key->id @endphp" class="fa fa-trash-o"></i></a>
                                    @endif
                                </td>
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
                        url:"{{route('settings.Sortable')}}",
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
                    //location.href="/nedmin/settings/delete/" + destroy_id;
                    $.ajax({
                        type: 'DELETE',
                        url: '/nedmin/settings/delete/' + destroy_id,
                        success: function(result) {
                            if(result) { 
                                alertify.success('İşlem Başarılı');
                            }
                            secondDelay(4580);
                        },
                        error: function(error) {
                           location.reload();
                        }
                    });
                },
                function() {
                    alertify.error('Silme işlemi iptal edildi');
                }
            );
        });

        function secondDelay($milisecond) {
            setTimeout(function(){ location.reload(); }, $milisecond);
        }
    </script>
@endsection

@section('css') 
@endsection

@section('js')
@endsection