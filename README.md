## Elective Manager New
> This is the Elective Manager which will be used for Elective allotments (Open electives as well as Departmental electives). <br>
> Develop it keeping in mind its **Flexibility**, **Stability** and **Security**.

## Project Completed - **X/Y - 0%**
Calculated from Features to Implement completion percentage.

## Languages and Packages used -
> PHP, Javascript, MySql, Google Material Design

## Features to Implement

### **General**
- [ ] Should work for both Open elective as well as Departmental elective allotments.
- [ ] Should have a secure password recovery mechanism.
- [ ] 3 login interfaces - **Admin**, **Student** and **Department**.
- [ ] Do routing.
- [ ] Use OOP and functions to get the work done.
- [ ] Use Javascript for field validations or klein-php.
- [ ] Use Ajax for real time loading.
- [ ] Responsive Design.
- [ ] Open source this project and provide long term support.
- [ ] Prevent attacks eg. Sql Injection etc.
- [ ] Avoid code redundancy.
- [ ] All design etc. files common for all interfaces should be put together, reduces redundancy.

### **Admin Interface**
- [ ] Gets the final list of students selected for each elective.
- [ ] Gets the final confirmation from department for publishing elective (Already approved by Super Admin).
- [ ] Gets the notification when department deletes an elective/closes registration.
- [ ] Admin will get a mail if any of the above things happen.
- [ ] Can see all the available departments.
- [ ] Can see all the departments with no. of published electives.
- [ ] Can delete/unpublish/close registration for any elective.
- [ ] Will open registration for Departmental admins (will use an authorization key for registration, it'll be a Hash). This key will be generated automatically, admin will have a separate interface to generate the key (dynamic creation of it).
- [ ] if (total no. of seats for electives < no. ofstudents registered) { then admin will get a notification regarding this along with Super admin. } <sup>problem</sup> there is a problem in it, how can we handle this for all different type of electives(UG 3rd year & PG final year, branch wise).

### **Department Interface**
- [ ] 2 Admins (Super Admin (H.O.D.) and Elective poster (Professor)).
- [ ] Super Admin gets the final list of students selected for each elective.
- [ ] Elective poster have the ability to post multiple electives.
- [ ] Elective posting confirmation will go to Admin once approved by Super Admin.
- [ ] Elective when approved by Super Admin and published, will be open for registrations.
- [ ] if (total no. of seats for electives < no. ofstudents registered) { then admin will get a notification regarding this along with Super admin. } <sup>problem</sup> there is a problem in it, how can we handle this for all different type of electives(UG 3rd year & PG final year, branch wise).
- [ ] Add UG/PG Elective, subject codes will be chosen from dropdown.
- [ ] Add option for no. of seats available for the elective.
- [ ] if (no. of registered students for the elective <= no. of seats available) { Students status will remain automatically **Confirmed** }<br>
else if ( no. of students > no. of seats available) { then no. of students till no. of seats (sorted by CGPA and priority) will have their status as **Confirmed** by default and others status will be **Waiting** }
- [ ] if (the elective poster rejects any student with the status as **Confirmed** by default) { then he/she needs to give a strong and valid reason for rejection with reason of min. characters 10.<br>Student gets its notification by mail and on the interface. }
- [ ] Add auto close registration when the no. of students == no. of seats available, will opt for this option on the time of publishing of elective.
- [ ] Can view the list of students selected and the students who've applied for the elective.
- [ ] When posting elective will post the following details -
<ol>
<li>No. of seats</li>
<li>Elective code (as multiple electives)</li>
<li>Name of professor taking the course</li>
<li>Any additional information</li>
<li>Auto close registration/not</li>
</ol>
- [ ] Have the option to update elective details after posting (Keep in mind about auto close registration case).
- [ ] Timestamp will be added on every registration request,rejection, publishing elective, super admin confirmation, updating, etc.
- [ ] Department name, elective names, etc. will be available from CC.

### **Student Interface**
- [ ] Mail sending on successful allotment of seat, rejection.
- [ ] Login will be with the help of roll no.
- [ ] After logging in student will prioritize electives (Priority once set can't be updated - show prompt).
- [ ] Show students all info available for the elective including the no. of vacant seats, also the last CGPI selected and applied (update dynamically).
- [ ] After the student applies show his/her status in each elective (update dynamically).
- [ ] Timestamp while setting priorities will also be set.