🧑‍🏫 LearnTogether – Full-Stack Tutoring Platform
Role-based web app with video, scheduling, and payment logic

Overview:
LearnTogether is a full-stack mock tutoring platform that supports both students and teachers. It includes a secure login system, session scheduling, live video integration, payment tracking, and a custom-built teacher dashboard for course management. The UI was inspired by platforms like Pluralsight, and built for clarity, professionalism, and warmth.

Stack Used:

    Frontend: Vue 3 + TypeScript + Pinia + CSS Grid/Flexbox

    Backend: Laravel + MySQL + Sanctum

    Features: Role-based access, session booking, payments, teacher dashboards, dynamic course listings, live video

🎯 Key Features

    🧑‍🎓 Dual-role login: separate authentication flows for students and teachers

    📅 Session scheduler: date picker with time validation, backend validation, and real-time error handling

    💵 Payments dashboard: client payment form + visual payment history with filtering

    📚 Teacher dashboard: create, edit, and manage courses with optional resources

    🎥 Live video chat: integrated placeholder setup for future Zoom/WebRTC expansion

    📦 API-first design: all front-end views pull data from real Laravel API endpoints

🌈 Visuals & Vibes

    Clean, cozy layout
    Everything’s laid out in a way that actually makes sense. Whether you’re a tired teacher or a curious kid, it’s easy to find what you need.

    Separate vibes for students vs. teachers
    Not just one dashboard fits all — I built separate flows so everyone sees only what they care about. Cleaner, faster, less brain noise.

    Colors that work with you, not against you
    No eyeball-murdering neons. Just soft backgrounds, glowy accents, and high-contrast where it counts. It’s calm but still got ✨pop✨.

    Homepage that actually feels like an app
    Styled it kinda like Pluralsight — big bold header, warm welcome, glowy buttons, and actual course previews right on the front page.

    Real data, not fake UI
    Dashboards pull from real backend data — not just mocked JSON or vibes. Payments? Sessions? Courses? All real and trackable.

    Interactive form stuff that feels nice
    Dropdowns, datepickers, errors that actually tell you what’s wrong? Yeah, it’s got that. Little stuff matters.

    Buttons that say “click me” without yelling
    Soft glow, smooth hovers, and a little motion — enough to be playful, not enough to be annoying.

✨ What Made It Fun

This project was one of those “ohhhhhh snap it’s all coming together” moments.

    Seeing dashboards populate with real data from my Laravel backend felt like magic

    I wired up the video chat and session scheduler in way less time than expected

    Designing the teacher flow (from register to course creation) made me think like a product designer

    It’s modular, scalable, and clean — no spaghetti code here 🧼

💡 What I Learned

    How to manage user state securely with Pinia + tokens + route guards

    How to structure Laravel controllers and API routes for multi-role systems

    That good UI doesn’t have to be boring — even dashboards can look dope