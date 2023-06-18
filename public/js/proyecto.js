
 function openCreateProject() {
    $("#popup4").removeClass('hidden');
 }

 function submitCreate() {
    $form = $("#create_update_project");

    $form.attr('action', 'proyectos');
    $form.submit();
 }

 function closeModal() {

   $("#popup4").addClass('hidden');

   location.reload();
}

$("#search_project_input").keydown(function(event) {
   if (event.keyCode === 13) {
     event.preventDefault(); 

     $form = $("#search_project");
     $form.submit();
   }
});

$('input[type="search"]').on('search', () => {
   $form = $("#search_project");
   $form.submit();
 });

$("#delete_input").click(() => {
   $form = $("#search_project");
   $form.submit();
})