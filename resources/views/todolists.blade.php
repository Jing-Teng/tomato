<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  
  <title>Todolist</title>
</head>

<body>
    <div class="task">
    <input type="text" placeholder="請輸入代辦事項" 
            @keyup.enter="addTodo(newTodo)" v-model="newTodo">
    <h2>事項列表</h2>
    <ul >
        <li v-for="todo in todos" v-bind:class="{ active: todo.completed }">
        <input  type="checkbox" v-model="todo.completed">
        @{{todo.content}}
        - <a href="#" @click.prevent="removeTodo(todo)">刪除</a>
        </li>
    </ul>
    
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.0.3/vue.js"></script>
<script src="/js/todolists.js"></script>
</div>
</body>
</html>
