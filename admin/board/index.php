<!DOCTYPE html>
<html lang="en" class="" style="height: auto;">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <style>
      * {
  box-sizing: border-box;
}

body {
  font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
  min-height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
}

.todo-container {
  width: 1000px;
  height: 80vh;
  display: flex;
}

.status {
  width: 25%;
  background-color: #f3f3f3;
  position: relative;
  padding: 60px 1rem 0.5rem;
}

.status:nth-child(even) {
  background-color: #e9e9e96b;
}

.status h1 {
  position: absolute;
  top: 0;
  left: 0;
  background-color: #343434;
  color: #f3f3f3;
  margin: 0;
  width: 100%;
  padding: 0.5rem 1rem;
  font-size: 1.5rem;
}

.todo {
  display: flex;
  justify-content: space-between;
  align-items: center;
  position: relative;
  background-color: #fff;
  box-shadow: rgba(15, 15, 15, 0.1) 0px 0px 0px 1px,
    rgba(15, 15, 15, 0.1) 0px 2px 4px;
  border-radius: 4px;
  padding: 0.5rem 1rem;
  font-size: 1.5rem;
  margin: 0.5rem 0;
}

.todo .close {
  position: absolute;
  right: 1rem;
  top: 0rem;
  font-size: 2rem;
  color: #ccc;
  cursor: pointer;
}

.todo .close:hover {
  color: #343444;
}

/* modal */

.close-modal {
  background: none;
  border: none;
  font-size: 1.5rem;
}

.modal {
  width: 450px;
  position: fixed;
  top: -50%;
  left: 50%;
  transform: translate(-50%, -50%);
  transition: top 0.3s ease-in-out;
  border: 1px solid #ccc;
  border-radius: 10px;
  z-index: 2;
  background-color: #fff;
}

.modal.active {
  top: 15%;
}

.modal .header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  border-bottom: 1px solid #ccc;
  padding: 0.5rem;
  background-color: rgba(0, 0, 0, 0.05);
}

.modal .body {
  padding: 0.75rem;
}

#overlay {
  display: none;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.3);
}

#overlay.active {
  display: block;
}

#todo_input,
#todo_submit {
  padding: 0.5rem 1rem;
  width: 100%;
  margin: 0.25rem;
}

#todo_submit {
  background-color: #4caf50;
  color: #f3f3f3;
  font-size: 1.25rem;
  border: none;
}
    </style>

    <title>Draggable Todo App</title>
  </head>
  <body>
    <!-- modal -->
    <div class=".modal" id="todo_form">
      <div class="header">
        <!--<div class="title">Add Todo</div>
        <button class="btn close-modal">&times;</button>-->
      </div>
      <div class="body">
        <input type="text" id="todo_input" />
        <input type="submit" value="Add New Task" id="todo_submit" />
      </div>
    </div>
    <!-- todo -->
    <div class="todo-container">
      <div class="status" id="no_status">
        <h1>No Status</h1>
 
        <div class="todo" draggable="true">
          First Task
          <span class="close">&times;</span>
        </div>
      </div>
      <div class="status">
        <h1>Not Started</h1>
      </div>
      <div class="status">
        <h1>In Progress</h1>
      </div>
      <div class="status">
        <h1>Completed</h1>
      </div>
    </div>

    <!--<div id="overlay"></div>-->

    <script>
      const todos = document.querySelectorAll(".todo");
const all_status = document.querySelectorAll(".status");
let draggableTodo = null;

todos.forEach((todo) => {
  todo.addEventListener("dragstart", dragStart);
  todo.addEventListener("dragend", dragEnd);
});

function dragStart() {
  draggableTodo = this;
  setTimeout(() => {
    this.style.display = "none";
  }, 0);
  console.log("dragStart");
}

function dragEnd() {
  draggableTodo = null;
  setTimeout(() => {
    this.style.display = "block";
  }, 0);
  console.log("dragEnd");
}

all_status.forEach((status) => {
  status.addEventListener("dragover", dragOver);
  status.addEventListener("dragenter", dragEnter);
  status.addEventListener("dragleave", dragLeave);
  status.addEventListener("drop", dragDrop);
});

function dragOver(e) {
  e.preventDefault();
  //   console.log("dragOver");
}

function dragEnter() {
  this.style.border = "1px dashed #ccc";
  console.log("dragEnter");
}

function dragLeave() {
  this.style.border = "none";
  console.log("dragLeave");
}

function dragDrop() {
  this.style.border = "none";
  this.appendChild(draggableTodo);
  console.log("dropped");
}

/* modal */
const btns = document.querySelectorAll("[data-target-modal]");
const close_modals = document.querySelectorAll(".close-modal");
//const overlay = document.getElementById("overlay");

btns.forEach((btn) => {
  btn.addEventListener("click", () => {
    document.querySelector(btn.dataset.targetModal).classList.add("active");
    overlay.classList.add("active");
  });
});

close_modals.forEach((btn) => {
  btn.addEventListener("click", () => {
    const modal = btn.closest(".modal");
    modal.classList.remove("active");
    overlay.classList.remove("active");
  });
});

window.onclick = (event) => {
  if (event.target == overlay) {
    const modals = document.querySelectorAll(".modal");
    modals.forEach((modal) => modal.classList.remove("active"));
    overlay.classList.remove("active");
  }
};

/* create todo  */
const todo_submit = document.getElementById("todo_submit");

todo_submit.addEventListener("click", createTodo);

function createTodo() {
  const todo_div = document.createElement("div");
  const input_val = document.getElementById("todo_input").value;
  const txt = document.createTextNode(input_val);

  todo_div.appendChild(txt);
  todo_div.classList.add("todo");
  todo_div.setAttribute("draggable", "true");

  /* create span */
  const span = document.createElement("span");
  const span_txt = document.createTextNode("\u00D7");
  span.classList.add("close");
  span.appendChild(span_txt);

  todo_div.appendChild(span);

  no_status.appendChild(todo_div);

  span.addEventListener("click", () => {
    span.parentElement.style.display = "none";
  });
  //   console.log(todo_div);

  todo_div.addEventListener("dragstart", dragStart);
  todo_div.addEventListener("dragend", dragEnd);

  document.getElementById("todo_input").value = "";
  todo_form.classList.remove("active");
  overlay.classList.remove("active");
}

const close_btns = document.querySelectorAll(".close");

close_btns.forEach((btn) => {
  btn.addEventListener("click", () => {
    btn.parentElement.style.display = "none";
  });
});
    </script>
  </body>
  </html>
