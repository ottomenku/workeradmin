@php  
       
$menuT=[
'admin'=>[                                          
['/root/proba','proba'],                                
['/root/conf' ,' Config'],
['/root/roles' ,'Jogok'],
],

'manager'=>[  
['/manager/users', 'Felhasználók'],
['/manager/workers' , 'Dolgozók'],
['/manager/statuses' ,'Dolgozói státusz'],
['/manager/workergroups' , 'Dolgozói csoportok'],
['/manager/workertypes' ,  'Munka tipusok'],
['/manager/days','Napok'],
['/manager/daytypes', 'Naptipusok'],
['/manager/timeframes', 'Időkeretek'],
['/manager/timetypes',   'Munkaidőtipusok'],
['/manager/wroles', 'Munkarendek'],
['/manager/wroleunits', 'Műszakok'],
['/manager/wroletimes',  'Műszak idők'],
['/workadmin/workerdays' , 'Költdég térítés'],
],

'workadmin'=>[
['/workadmin/workerwroles','Dolgozói munkarendek'],
['/workadmin/workertimeframes ', 'Dolgozói időkeretek'],
['/workadmin/workerwroleunit', 'Dolgpzói műszakok'],
['/workadmin/workerdays',  'Napok'],
['/workadmin/workertimes', 'Munkaidők'],
['/workadmin/workertimeswish', 'Munkaidő kérelmek'],
['/workadmin', ' Szabadság,betegállomány'],
['/workadmin/workerdays',  'kiküldetés'],
],
'worker'=>[
['/worker/workertimeswish', 'Munkaidők'],
['/worker/workerwroleunits', 'Műszakcsere'],
['/worker/workerdays', 'Saját adatok'],
['/worker/workerdays',  'Naptár'],
['/worker/workerdays', 'Szabadság, betegállomány'],
['/workadmin/workerdays', 'kiküldetés'],
['/workadmin/workerdays', 'Munkaidő nyilvántartás'],
['/workadmin/workerdays', 'költdég térítés']
]
];
@endphp