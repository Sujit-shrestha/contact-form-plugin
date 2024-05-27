<?php

/**
 * Template for the CFP form
 * 
 */

defined('ABSPATH') || exit;

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CFP Form</title>

  <!-- Usingg tailwind css for css  -->
  <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">

</head>

<body>
  <div class="cfp_form_wrapper ">
    <div class="shadow py-6 bg-red-50">
      <form id="cfp_form_template" action="#" method="POST">

        <table style="border: 1px solid red">

          <tr>
            <td class="px-6 py-3">
              <label name="name " for="name">Name</label>
            </td>
            <td class="px-6 py-3">
              <input
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                type="text" name="name" id="cfp_from_name" placeholder="Enter your name..." required>
            </td>
          </tr>

          <tr>
            <td class="px-6 py-3">
              <label for="email">Email</label>
            </td>
            <td class="px-6 py-3">
              <input
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                type="email" name="email" id="cfp_from_email" placeholder="Enter your email..." required
                pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$ ">
            </td>
          </tr>

          <tr>
            <td class=" px-6 py-3 ">
              <label for="cfp_form_subject">Subject</label>
            </td>
            <td class="px-6 py-3">
              <input
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                type="text" name="subject" id="cfp_form_subject" placeholder="Enter subject of query...">
            </td>
          </tr>

          <tr>
            <td class="px-6 py-3">
              <label for="cfp_form_message">Message</label>
            </td>
            <td class="px-6 py-3">
              <textarea id="cfp_form_message" rows="4"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                placeholder="Write your message here..."></textarea>

            </td>
          </tr>

          <tr>
            <td class="px-6 py-3 ">
              <input id="cfp_form_btn"
                class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500  rounded"
                type="submit" value="Send Quote" />
            </td>
          </tr>

        </table>

    </div>
    </form>
  </div>
</body>

</html>