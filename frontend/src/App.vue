<!-- <script setup>
import { ref, onMounted } from 'vue';
import './main.css';
import axios from 'axios';

const name = ref('')
const content_todo = ref('')
const todos = ref([]);

const doneEdit = (index)=>{
    todos.value[index].isEditing = false
}

const cancelEdit = (index) =>{
    todos.value[index].isEditing = false
}



const removeTodo = async (todoID) => {
    try {
        const response = await axios.post('http://localhost/vueProject/backend/api/todo/remove_todo.php', {
            todoId:todoID,
        }, 
        {
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        });

        console.log('Todo removed:', response.data);

        todos.value = response.data
    } catch (error) {
        console.error('Error removing todo:', error);
    }


}
    
const editTodo = (index)=>{

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
        
        todos.value = response.data; 
        console.log('Todo added:', todos.value);
        console.log('Todo added:', response.data);
    } catch (error) {
        console.error('Error adding todo:', error);
    }
    content_todo.value = '';
};


onMounted(async () => {
  try {
    const response = await axios.post('http://localhost/vueProject/backend/api/todo/get_data.php');
    todos.value = response.data;
    console.log(todos.value)
  } catch (error) {
    console.error('Error fetching todos:', error);
  }
});

</script> -->
<!-- <template>
    <div class="main">
        <input type="text" v-model="name" placeholder="Type here" />
        <p>Hello : {{ name }}</p>

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
            <tr v-for="(todo, index) in todos" :key="index">
                <td v-if="todo.isEditing == true">{{ index+1 }} - <input type="text" v-model="todo.content"><button @click="doneEdit(index)">Done</button><button @click="cancelEdit(index)">Cancel</button></td>
                <td v-else>{{ index+1 }} - {{ todo.content}}<button @click="editTodo(index)" >EDIT</button><button  @click="removeTodo(todo.id)" >DEL</button></td>

              </tr>
           </tbody>
           
        </table>

    </div>  

    <br>
</template> -->
<template>
    <nav>
        <router-link to="/">Home</router-link> |
        <router-link to="/login">Login</router-link>
    </nav>
    <router-view />
</template>
  
<script>
import './main.css'
export default {
    name: 'App',
}
</script>
  