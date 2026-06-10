$(document).ready(function(){

    updateCount();

    $("#addBtn").click(function(){

        let task = $("#taskInput").val();

        if(task=="")
        {
            alert("Enter Task");
            return;
        }

        $("#taskList").append(
            `
            <li>

                <span class="taskText">
                    ${task}
                </span>

                <button class="completeBtn">
                    Complete
                </button>

                <button class="deleteBtn">
                    Delete
                </button>

            </li>
            `
        );

        $("#taskInput").val("");

        updateCount();

    });

    $(document).on("click",".deleteBtn",function(){

        $(this).parent().remove();

        updateCount();

    });

    $(document).on("click",".completeBtn",function(){

        $(this).parent().toggleClass("completed");

    });

    $(document).on("dblclick",".taskText",function(){

        let currentText=$(this).text();

        let newText=prompt(
            "Edit Task",
            currentText
        );

        if(newText)
        {
            $(this).text(newText);
        }

    });

    $("#themeBtn").click(function(){

        $("body").toggleClass("dark");

    });

    $(document).on("click","li",function(event){

        console.log(
            "Clicked Element : ",
            event.target
        );

    });

    function updateCount(){

        $("#count").text(
            $("#taskList li").length
        );

    }

});