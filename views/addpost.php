<?php
use app\core\Application;
?>



<div class="flex justify-center m-32">
  <div>
    <div class="form-floating mb-3 xl:w-96">
        <div class="mb-2">
            Add posts
        </div>
        <form action="/addposts" method="POST">
      <input type="text" class="form-control
        block
        w-full
        px-3
        py-1.5
        text-base
        font-normal
        text-gray-700
        bg-white bg-clip-padding
        border border-solid border-gray-300
        rounded
        transition
        ease-in-out
        m-0
        focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="floatingInput" placeholder="Tittle" name="title">
      <label for="floatingInput" class="text-gray-700">Text</label>
    </div>
    <div class="form-floating mb-3 xl:w-96">
      <textarea type="text" class="form-control
        block
        w-full
        px-3
        py-1.5
        text-base
        font-normal
        text-gray-700
        bg-white bg-clip-padding
        border border-solid border-gray-300
        rounded
        transition
        ease-in-out
        m-0
        focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="floatingPassword" placeholder="Body post" name="body">
      </textarea>
      <label for="floatingPassword" class="text-gray-700">Body</label>
    </div>
    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
    </form>
  </div>
</div>