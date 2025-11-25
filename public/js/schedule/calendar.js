document.addEventListener('DOMContentLoaded', function () {

    // Determine base API prefix (works in local dev)
    const API_BASE = '/api/calendar';
  
    // default mode
    let currentMode = 'work_orders';
  
    // Map modes -> endpoints & default colors
    const MODE_MAP = {
      work_orders: { url: `${API_BASE}/work-orders` },
      tasks: { url: `${API_BASE}/tasks` },
      tools: { url: `${API_BASE}/tool` },
      non_routine: { url: `${API_BASE}/non-routine` },
      task_cards: { url: `${API_BASE}/task-cards` },
    };
  
    // FullCalendar initialization
    const calendarEl = document.getElementById('fullcalendar');
    const calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      headerToolbar: false,
      height: 650,
      eventDisplay: 'block',
      eventColor: '#3788d8',
      eventClick: function(info) {
        // open modal or side panel - you can implement later
        const evt = info.event.extendedProps;
        alert(`${info.event.title}\nType: ${evt.type || 'n/a'}`);
      }
    });
  
    calendar.render();
  
    // function to fetch events for a mode and load them
    async function loadEventsForMode(mode) {
      const conf = MODE_MAP[mode];
      if (!conf) return;
      try {
        const res = await fetch(conf.url);
        const data = await res.json();
        // FullCalendar expects events with { id, title, start, end, color }
        const events = data.map(e => ({
          id: e.id,
          title: e.title,
          start: e.start,
          end: e.end,
          color: e.color || undefined,
          extendedProps: { type: e.type || mode }
        }));
        calendar.removeAllEvents();
        calendar.addEventSource(events);
      } catch (err) {
        console.error('Failed to load events', err);
      }
    }
  
    // initial load
    loadEventsForMode(currentMode);
  
    // view mode selector buttons (component created earlier)
    document.querySelectorAll('.view-mode-selector button').forEach(btn => {
      btn.addEventListener('click', function () {
        // deactivate all
        document.querySelectorAll('.view-mode-selector button').forEach(b => b.classList.remove('active'));
        this.classList.add('active');
  
        const mode = this.dataset.mode;
        if (!mode) return;
        currentMode = mode;
        // load events for the new mode
        loadEventsForMode(mode);
      });
    });
  
    // FullCalendar toolbar hooks
    document.getElementById('fc-prev').addEventListener('click', () => calendar.prev());
    document.getElementById('fc-next').addEventListener('click', () => calendar.next());
    document.getElementById('fc-today').addEventListener('click', () => calendar.today());
    document.getElementById('fc-view-select').addEventListener('change', function () {
      const v = this.value;
      calendar.changeView(v);
    });
  
  });
  