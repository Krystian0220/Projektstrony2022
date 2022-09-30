import { Controller } from '@hotwired/stimulus';
import Swal from 'sweetalert2';
/*
 * This is an example Stimulus controller!
 *
 * Any element with a data-controller="hello" attribute will cause
 * this controller to be executed. The name "hello" comes from the filename:
 * hello_controller.js -> "hello"
 *
 * Delete this file or adapt it for your use!
 */
import axios from 'axios';

export default class extends Controller {
     onSubmit(event) {
        event.preventDefault();
         Swal.fire({
             title: 'Are you sure?',
             text: "You won't be able to revert this!",
             icon: 'warning',
             showCancelButton: true,
             confirmButtonColor: '#3085d6',
             cancelButtonColor: '#d33',
             confirmButtonText: 'Yes, delete it!',
         }).then((result) => {
             if (result.isConfirmed) {
                 Swal.fire(
                     'Deleted!',
                     'Your file has been deleted.',
                     'success',
                 )
             }
         })

     }
}
