@extends('layouts.app')

@section('scripts')
<script>
    function generateAlertHTML(message, classCSS) {
        let htmlAlert = '<div class="container">' +
               '<div class="row justify-content-center"><div class="col-md-9 col-md-offset-1">' +
               '<div class="alert ' + classCSS + ' alert-dismissible fade show">' + message +
               '<button type="button" data-dismiss="alert" aria-label="Close" class="close">' +
               '<span aria-hidden="true">×</span></button></div></div></div></div>';

        let content = document.getElementsByClassName('content');
        content[0].insertAdjacentHTML('afterbegin', htmlAlert);
    }

    function disableOrAbleBtnDelete() {
        let checkboxes = document.getElementsByName("checkboxes[]");
		let numElements = checkboxes.length;
		let btnDeleteElement = document.getElementById("btnDelete");

		for(var x=0; x < numElements; x++){
            checkboxes[x].onclick = () => {
                let count = document.querySelectorAll("input[name='checkboxes[]']:checked").length;
                btnDeleteElement.disabled = count ? false : true;
		   }
		}
    }

    async function btnDeleteAction() {
        let checkboxes = document.getElementsByName("checkboxes[]");
        let numElements = checkboxes.length;        
        
		for(let x = 0; x < numElements; x++) {
            if(checkboxes[x].checked && checkboxes[x].value != 0 && checkboxes[x].value != null && checkboxes[x].value != undefined){
                let url = "{{ route('brand.delete.array', ':id') }}";
                url = url.replace(':id', checkboxes[x].value);

                httpRequestPromise("get", url).then(function (response) { 
                    localStorage.setItem("ItemsSuccessfullyDeleted", true);
                }, 
                function (error) {
                    localStorage.setItem("ItemsSuccessfullyDeleted", false);
                });
            }
        }

        setInterval(() => location.reload(), 500);
    }

    function formattedArrayOfId(data){
        let arrayId = "";
        for(let i = 0; i < data.length; i++) {
            arrayId += "." + data[i];
        }

        return arrayId;
    }

    function executeBeforePageLoad() {
        disableOrAbleBtnDelete();
        let itemsSuccessfullyDeleted = localStorage.getItem("ItemsSuccessfullyDeleted");
        if(itemsSuccessfullyDeleted !== null && itemsSuccessfullyDeleted === "true") {
            generateAlertHTML("Marcas deletada com sucesso!", "alert-success");
            localStorage.clear();
        } else if(itemsSuccessfullyDeleted !== null && itemsSuccessfullyDeleted === "false") {
            generateAlertHTML("Erro ao deletar marca!", "alert-danger");
            localStorage.clear();
        }
    }

    function markAllItems(checkboxes) {
        checkboxes.forEach((checkbox) => checkbox.checked = true);
    }

    function unmarkAllItems(checkboxes) {
        checkboxes.forEach((checkbox) => checkbox.checked = false);
    }

    function markUnmarkAllItems() {
        let checkboxes = document.getElementsByName('checkboxes[]');
        let checkboxMarkUnmarkAllItems = document.getElementById('markUnmarkAllItemsCheckbox');    
        let btnDeleteElement = document.getElementById("btnDelete");

        if(checkboxMarkUnmarkAllItems.checked) {
            markAllItems(checkboxes);
            btnDeleteElement.disabled = false;
        } else {
            unmarkAllItems(checkboxes);  
            btnDeleteElement.disabled = true;  
        }   
    }

    function btnDeleteBrandById(id) {
        var deleteBrand = confirm("Você realmente deseja deleter essa marca?");

        var url = "{{ route('brand.delete', ':id') }}";
        url = url.replace(':id', id);

        if(deleteBrand)
             window.location.href = url;
    }

    function httpRequestPromise(method, url, data) {
        return new Promise(function (resolve, reject) {
            let xmlHttp = new XMLHttpRequest();
            let meta = document.getElementsByName('csrf-token');
            let token = meta[0].content;
            xmlHttp.open(method, url); 
            xmlHttp.setRequestHeader('X-CSRF-TOKEN', token);
            xmlHttp.onload = function () {
                if(xmlHttp.readyState == 4 && xmlHttp.status == 200)
                {
                    resolve(xmlHttp.responseText);
                } else {
                    reject(xmlHttp.responseText);
                }
            }
            if(data)
                xmlHttp.send(data); 
            else
                xmlHttp.send();
        });
    }

    window.onload = executeBeforePageLoad;
</script>
@endsection

@section('content')
<div class="content">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Marcas de Refrigerante</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <p>
                        <a href="{{ route('brand.store') }}" class="btn btn-primary">Adicionar</a>
                        <button id="btnDelete" href="{{ route('brand.store') }}" class="btn btn-danger" onclick="btnDeleteAction()" disabled>Deletar</button>
                    </p>
                    <table class="table table-striped">
                        <thead>
                            <tr>   
                                <th scope="col">                             
                                    <label class="checkbox">
                                        <input id="markUnmarkAllItemsCheckbox" onclick="markUnmarkAllItems();" type="checkbox" />
                                        <span class="checkbox-placeholder"></span>
                                    </label>
                                </th>
                                <th scope="col">Marca</th>
                                <th scope="col">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($brands as $item)
                            <tr>
                                <td>
                                    <label class="checkbox">
                                        <input name="checkboxes[]" id="{{ $item->Id }}" value="{{ $item->Id }}" onclick="" type="checkbox" />
                                        <span class="checkbox-placeholder"></span>
                                    </label>
                                </td>
                                <td>{{ $item->Name }}</td>
                                <td>
                                    <a href="{{ route('brand.edit', $item->Id) }}"><i class="fa fa-edit" style="color: blue"></i></a>
                                    <a onclick="btnDeleteBrandById({{ $item->Id }});" style="cursor:pointer;">
                                        <i class="fa fa-remove" style="color: red"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                        {!! $brands->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
