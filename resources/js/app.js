import './bootstrap';
import 'preline';

import Swal from 'sweetalert2'
import { Calendar } from '@fullcalendar/core'
import dayGridPlugin from '@fullcalendar/daygrid'

window.Swal = Swal




document.addEventListener('DOMContentLoaded', () => {
    const el = document.getElementById('calendar')
    if (!el) return

    const calendar = new Calendar(el, {
        plugins: [dayGridPlugin],
        initialView: 'dayGridMonth',
        height: 'auto',

        events: '/calendar/notes',

        eventDisplay: 'dot', // still good
        dayMaxEvents: false,
    })

    calendar.render()
})

