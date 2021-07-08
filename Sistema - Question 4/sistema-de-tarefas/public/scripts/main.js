const csrftoken = document.currentScript.getAttribute('csrf');
const url = document.currentScript.getAttribute('url');

const deletar = (id) => {
  $.ajax({
    url: `${url}/api/v1/tarefa/deletar/${id}`,
    type: 'DELETE',
    headers: {
      'X-CSRF-TOKEN': csrftoken
    },
    success: (req, res, stat) => {
      fetch();
    },
    error: (req, res, stat) => {
      fetch();
      alert('Erro: ' + stat.status + ', Essa tarefa não pode ser deletada!');
    }
  })
}

const fetch = () => {

  let tarefas = [];
  let priorityMap = ['Sem prioridade','Baixa', 'Média', 'Alta'];

  $('#pending__action').empty();
  $('#inprogress__action').empty();
  $('#finished__action').empty();
  /*
  <li draggable="true" ondragstart="drag(event)" class="list-group-item" id="item-${el.id}">
    <div id="titulo"> 
      <h5> ${el.title} </h5>
    </div> 
    <hr> 
    <div id="desc"> 
      <p> ${el.description} </p> 
    </div>
    <div class="text-muted"> ${el.priority} </div>
    <hr>
    <div class="d-flex justify-content-between" id="interactions"> 
      <button onclick="deletar(${el.id})" class="btn btn-outline-danger px-2 py-1">
        <i class="fas fa-trash"></i>
      </button> 
      <button onclick="alterar(${el.id})" class="btn btn-outline-warning px-2 py-1">
        <i class="fas fa-pencil-alt"></i>
      </button>
    </div> 
  </li>`
  */
  $.ajax({
    url: `${url}/api/v1/tarefa`,
    context: 'application/json'
  }).done((res) => {
    tarefas = JSON.parse(res);
    tarefas.map((el) => {
      if (el.status === 0) $('#pending__action').append(`<li draggable="true" ondragstart="drag(event)" class="list-group-item" id="item-${el.id}"><div id="titulo"> <h5> ${el.title} </h5> </div> <hr> <div id="desc"> <p> ${el.description} </p>  </div> <div class="text-muted" style="position:relative; top:18px;"> Prioridade: <b>${priorityMap[el.priority]}</b> </div> <hr> <div class="d-flex justify-content-between" id="interactions"> <button onclick="deletar(${el.id})" class="btn btn-outline-danger px-2 py-1"><i class="fas fa-trash"></i></button> <button onclick="alterar(${el.id})" class="btn btn-outline-warning px-2 py-1"><i class="fas fa-pencil-alt"></i></button> </div> </li>`).hide().slideDown(400);
      if (el.status === 1) $('#inprogress__action').append(`<li draggable="true" ondragstart="drag(event)" class="list-group-item" id="item-${el.id}"><div id="titulo"> <h5> ${el.title} </h5> </div> <hr> <div id="desc"> <p> ${el.description} </p>  </div> <div class="text-muted" style="position:relative; top:18px;"> Prioridade: <b>${priorityMap[el.priority]}</b> </div> <hr> <div class="d-flex justify-content-between" id="interactions"> <button onclick="deletar(${el.id})" class="btn btn-outline-danger px-2 py-1"><i class="fas fa-trash"></i></button> <button onclick="alterar(${el.id})" class="btn btn-outline-warning px-2 py-1"><i class="fas fa-pencil-alt"></i></button> </div> </li>`).hide().slideDown(400);
      if (el.status === 2) $('#finished__action').append(`<li draggable="true" ondragstart="drag(event)" class="list-group-item" id="item-${el.id}"><div id="titulo"> <h5> ${el.title} </h5> </div> <hr> <div id="desc"> <p> ${el.description} </p>  </div> <div class="text-muted" style="position:relative; top:18px;"> Prioridade: <b>${priorityMap[el.priority]}</b> </div> <hr> <div class="d-flex justify-content-between" id="interactions"> <button onclick="deletar(${el.id})" class="btn btn-outline-danger px-2 py-1"><i class="fas fa-trash"></i></button> <button onclick="alterar(${el.id})" class="btn btn-outline-warning px-2 py-1"><i class="fas fa-pencil-alt"></i></button> </div> </li>`).hide().slideDown(400);
    })
  });
}

const alterar = (id) => {
  let seletor = `#item-${id}`;
  let titulo = $(`${seletor} #titulo`);
  let desc = $(`${seletor} #desc`);
  let interactions = $(`${seletor} #interactions`);
  let titulovalor = titulo.text().trim();
  let descvalor = desc.text().trim();
  
  if ($(seletor).hasClass('alterando')) {
    titulo.html(`<h5>${titulovalor}</h5>`);
    desc.html(`<p> ${descvalor} </p>`);
    $(seletor).attr('draggable', 'true');
    $(`${seletor} #interactions #altbtn`).remove();
    $(seletor).removeClass('alterando');
  } else {
    interactions.prepend(`<button id="altbtn" onclick="altput(${id})" class="btn btn-outline-success">Alterar </button>`)
    titulo.html(`<textarea style="width:100%;resize:none;" rows="2" id="textTitle" placeholder="Titulo aqui!">${titulovalor}</textarea>`);
    desc.html(`<textarea style="width:100%;resize:none;" rows="5" id="textDesc" placeholder="Descrição aqui!">${descvalor}</textarea>`);
    $(seletor).attr('draggable', 'false');
    $(seletor).addClass('alterando');
  }
}

const statusDrop = (index,status) => {
  let id = index.replace(/[A-Z]|-/ig, '');
  
  $.ajax({
    url: `${url}/api/v1/tarefa/status`,
    type: 'POST',
    headers: {
      'X-CSRF-TOKEN': csrftoken
    },
    data:{
      'id': id,
      'status': status
    },
    success: (req, res, stat) => {
      fetch();
    },
    error: (req, res, stat) => {
      fetch();
    }
  })
}

const altput = (id) => {

  let title = $(`#item-${id} #textTitle`).val();
  let desc = $(`#item-${id} #textDesc`).val();

  console.log(title,desc);
  $.ajax({
    url: `${url}/api/v1/tarefa/atualiza`,
    type: 'PUT',
    headers: {
      'X-CSRF-TOKEN': csrftoken
    },
    data:{
      'id': id,
      'title': title,
      'desc': desc
    },
    success: (req, res, stat) => {
      fetch();
      console.log(stat);
    },
    error: (req, res, stat) => {
      fetch();
      console.log(req,res,stat);
    }
  })
}

const allowDrop = (e) => {
  e.preventDefault();
}

const drag = (e) => {
  e.dataTransfer.setData("text", e.target.id);
}

const drop = (e) => {
  e.preventDefault();
  let data = e.dataTransfer.getData("text");
  if(e.target.id === "pending__action") statusDrop(data,0);
  if(e.target.id === "inprogress__action") statusDrop(data,1);
  if(e.target.id === "finished__action") statusDrop(data,2);
}

$(document).ready(() => {

  fetch();

  $('#inprogress__action, #pending__action, #finished__action').hover(()=>{
    $('#inprogress__action, #pending__action, #finished__action').addClass('drophere');
  },()=>{
    $('#inprogress__action, #pending__action, #finished__action').removeClass('drophere');
  })

  //Responsive
  $(window).resize(() => {
    if ($(window).width() <= 768) {
      $('.pending__container').removeClass('col').removeClass('mx-2')
      $('.inprogress__container').addClass('my-5').removeClass('col').removeClass('mx-2')
      $('.finished__container').addClass('mb-5').removeClass('col').removeClass('mx-2')
    } else {
      $('.pending__container').addClass('col').addClass('mx-2')
      $('.inprogress__container').removeClass('my-5').addClass('col').addClass('mx-2')
      $('.finished__container').removeClass('mb-5').addClass('col').addClass('mx-2')
    }
  })

  //OnDocumentLoad
  if ($(window).width() <= 768) {
    $('.pending__container').removeClass('col').removeClass('mx-2')
    $('.inprogress__container').addClass('my-5').removeClass('col').removeClass('mx-2')
    $('.finished__container').addClass('mb-5').removeClass('col').removeClass('mx-2')
  } else {
    $('.pending__container').addClass('col').addClass('mx-2')
    $('.inprogress__container').removeClass('my-5').addClass('col').addClass('mx-2')
    $('.finished__container').removeClass('mb-5').addClass('col').addClass('mx-2')
  }
});