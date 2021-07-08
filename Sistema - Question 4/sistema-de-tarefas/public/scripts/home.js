const url = document.currentScript.getAttribute('url');

const pendentes = () =>{
  let tarefas = [];
  let pendentesCount = 0;
  $.ajax({
    url: `${url}/api/v1/tarefa`,
    context: 'application/json'
  }).done((res) => {
    tarefas = JSON.parse(res);
    tarefas.map((el) => {
      if (el.status === 0) pendentesCount++;
    })
    if (pendentesCount === 1) $('#pending__container').append(`<div class="bg-danger p-4 rounded">Você tem: ${pendentesCount} tarefa pendentes.</div>`).hide().fadeIn(200)
    if (pendentesCount > 1) $('#pending__container').append(`<div class="bg-danger p-4 rounded">Você tem: ${pendentesCount} tarefas pendentes.</div>`).hide().fadeIn(200)
  });
}

$(document).ready(() => {
  pendentes();
});