function Tabs(perm) {
    var tabs;
    if (perm == 3) {
        tabs = [
                    {
                        title: "Dashboard",
                        icon: "users",
                        link: '/dashboard-sales'
                    },
                   {
                       title: "Orders",
                       icon: "users",
                       link: '/dashboard-sales'
                   },
                   {
                       title: "Comments",
                       icon: "users",
                       link: '#'
                   },
                   {
                       title: "Sales Info",
                       icon: "users",
                       link: './dashboard-admin.html'
                   },
                   {
                       title: "Customers Info",
                       icon: "users",
                       link: './dashboard-admin.html'
                   }
               ];
    } else if (perm == 2) {
        tabs = [
                   {
                       title: "Comments",
                       icon: "users",
                       link: '/dashboard-sales'
                   },
                   {
                       title: "Orders",
                       icon: "users",
                       link: '#'
                   },
                   {
                       title: "Customers Info",
                       icon: "users",
                       link: './dashboard-admin.html'
                   }
               ];
    } else if (perm == 1) {
        tabs = [
                   {
                       title: "Comments",
                       icon: "users",
                       link: '/dashboard-sales'
                   },
                   {
                       title: "Orders",
                       icon: "users",
                       link: '#'
                   },
                   {
                       title: "Customers Info",
                       icon: "users",
                       link: './dashboard-admin.html'
                   }
               ];
    } else {
        // exit this application
    }

    var ul=document.createElement('ul');
    ul.className = "nav flex-column";
    for(i=0;i<tabs.length;i++)
    {
        var li=document.createElement('li');
        li.className = "nav-item";
        if (i == 0) {
            li.innerHTML="<a class=\"nav-link active\" href="+tabs[i].link+"><span data-feather="+tabs[i].icon+"></span>"+tabs[i].title+"</a>";
        } else {
            li.innerHTML="<a class=\"nav-link\" href="+tabs[i].link+"><span data-feather="+tabs[i].icon+"></span>"+tabs[i].title+"</a>";
        }
        ul.appendChild(li);
    }
    document.getElementById('side-menu').appendChild(ul);

}
