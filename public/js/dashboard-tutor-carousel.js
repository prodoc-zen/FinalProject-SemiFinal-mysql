        function goToOverview() 
        {
            document.getElementById('dashboard-tutor-session-css').disabled = false
            document.getElementById('dashboard-student-session-css').disabled = false
            // Switch to Carousel item #2 (index starts at 0)
            const myCarousel = document.querySelector('#dashboardCarousel');
            const carousel = bootstrap.Carousel.getOrCreateInstance(myCarousel);

            carousel.to(0); // Go to first slide
            
            


            document.getElementById('overviewLink').classList.add('active');
            document.getElementById('sessionsLink').classList.remove('active');
            document.getElementById('pendingRequestsLink').classList.remove('active');
            document.getElementById('profileLink').classList.remove('active');
            
        }
        
        function goToSessions() 
        {
            document.getElementById('dashboard-tutor-session-css').disabled = false
            document.getElementById('dashboard-student-session-css').disabled = true
            // Switch to Carousel item #2 (index starts at 0)
            const myCarousel = document.querySelector('#dashboardCarousel');
            const carousel = bootstrap.Carousel.getOrCreateInstance(myCarousel);

            carousel.to(1); // Go to second slide
            


            document.getElementById('sessionsLink').classList.add('active');
            document.getElementById('pendingRequestsLink').classList.remove('active');
            document.getElementById('overviewLink').classList.remove('active');
            document.getElementById('profileLink').classList.remove('active');
        }

        function goToPendingRequests() 
        {
            document.getElementById('dashboard-tutor-session-css').disabled = true
            document.getElementById('dashboard-student-session-css').disabled = true
            
            // Switch to Carousel item #2 (index starts at 0)
            const myCarousel = document.querySelector('#dashboardCarousel');
            const carousel = bootstrap.Carousel.getOrCreateInstance(myCarousel);

            carousel.to(2); // Go to third slide
            
            document.getElementById('sessionsLink').classList.remove('active');
            document.getElementById('pendingRequestsLink').classList.add('active');
            document.getElementById('overviewLink').classList.remove('active');
            document.getElementById('profileLink').classList.remove('active');
        }

        function goToProfile() 
        {
            document.getElementById('dashboard-tutor-session-css').disabled = true
            document.getElementById('dashboard-student-session-css').disabled = true
            
            // Switch to Carousel item #2 (index starts at 0)
            const myCarousel = document.querySelector('#dashboardCarousel');
            const carousel = bootstrap.Carousel.getOrCreateInstance(myCarousel);

            carousel.to(3); // Go to fourth slide
            
            document.getElementById('sessionsLink').classList.remove('active');
            document.getElementById('pendingRequestsLink').classList.remove('active');
            document.getElementById('overviewLink').classList.remove('active');
            document.getElementById('profileLink').classList.add('active');




            
        }

       