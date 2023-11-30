<template>
  <div class="main">
    <h1>Welcome,{{ $route.query.username }}</h1>
    <button @click="quitUser">QUIT</button>
    <br>
    <br>

    <form @submit.prevent="addTodoToDatabase(content_todo)">

      <div class="form">
        <input type="text" v-model="content_todo" placeholder="todo here" required />
        <input type="submit" value="Add" />
      </div>
    </form>
    <br>
    <button @click="removeAllTodos()"> Remove All</button>

    <table>
      <tbody>
        <tr v-if="message == true">there is no todo</tr>
        <tr v-for="(todo, index) in todos" :key="index">
          <td v-if="todo.isEditing == true">{{ index + 1 }} - <input type="text" v-model="todo.content"><button
              @click="doneEdit(index)">Done</button><button @click="cancelEdit(index)">Cancel</button></td>
          <td v-else>{{ index + 1 }} - {{ todo.content }}<button @click="editTodo(index)">EDIT</button><button
              @click="removeTodo(todo.id)">DEL</button></td>

        </tr>
      </tbody>

    </table>

  </div>

  <br>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import { useRouter } from 'vue-router';
const router = useRouter();


const content_todo = ref('')
const todos = ref([]);
let message = ref('')


const removeAllTodos = async ()=>{
  try {
    const response = await axios.post('http://localhost/vueProject/backend/api/todo/remove_all_todos.php',
      {
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded'
        }
      });

    if(response.data.length==0){
      console.log('no todo')
      message = true

    }else{
      message = false
    }

    todos.value = response.data
  } catch (error) {
    console.error('Error removing todo:', error);
  }

}
const doneEdit = (index) => {
  todos.value[index].isEditing = false
}

const cancelEdit = (index) => {
  todos.value[index].isEditing = false
}


const quitUser= ()=>{
  router.push({ path: '/login' });
}

const removeTodo = async (todoID) => {
  try {
    const response = await axios.post('http://localhost/vueProject/backend/api/todo/remove_todo.php', {
      todoId: todoID,
    },
      {
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded'
        }
      });

    if(response.data.length==0){
      console.log('no todo')
      message = true

    }else{
      message = false
    }

    todos.value = response.data
  } catch (error) {
    console.error('Error removing todo:', error);
  }


}

const editTodo = (index) => {

  console.log(todos.value[index])
  todos.value[index].isEditing = true

}


const addTodoToDatabase = async (todo) => {
  try {
    const response = await axios.post('http://localhost/vueProject/backend/api/todo/post_data.php', {
      todoContent: todo,
    },
      {
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded'
        }
      });

    if(response.data.length==0){
      console.log('no todo')
      message = true

    }else{
      message = false
    }
    todos.value = response.data;
    
    // console.log('Todo added:', todos.value);
    console.log('Todo added:', response.data.length);
  } catch (error) {
    console.error('Error adding todo:', error);
  }
  content_todo.value = '';
};


onMounted(async () => {
  try {
    const response = await axios.post('http://localhost/vueProject/backend/api/todo/get_data.php');
    todos.value = response.data;
    if(response.data.length==0){
      console.log('no todo')
      message = true

    }else{
      message = false
    }
    console.log(todos.value)
  } catch (error) {
    console.error('Error fetching todos:', error);
  }
});


</script>
