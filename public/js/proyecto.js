
 function openCreateProject() {
    $("#popup4").removeClass('hidden');
 }

 function submitCreate() {
    $form = $("#create_update_project");

    $form.attr('action', 'proyectos');
    $form.submit();
 }

 function deleteProject() {
    ("#popup5").removeClass('hidden');

    $.ajax({
        type: "GET",
        url: url_edit_task,
    })
 }