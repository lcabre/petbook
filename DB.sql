/*   script sql  - tablas con restricciones -   */

create table foto
       (
       id int not null auto_increment,                              
       nombre varchar(50) not null,     
       updated_at datetime not null,
       created_at datetime not null,                        
       primary key
               (
               id
               )
       );



create table video
       (
       id bigint not null auto_increment,                              
       nombre varchar(50) not null,  
       updated_at datetime not null,
       created_at datetime not null,                               
       primary key
               (
               id
               )
       );



create table tipo_mascota
       (
       id int not null auto_increment,                              
       nombre varchar(100) not null,  
       updated_at datetime not null,
       created_at datetime not null,                               
       primary key
               (
               id
               )
       );



create table cuenta
       (
       id int not null auto_increment,                              
       email varchar(255) not null,                              
       password varchar(50) not null,
       ultima_conexion datetime, 
       updated_at datetime not null,
       created_at datetime not null,                                 
       primary key
               (
               id
               )
       );



create table usuario
       (
       id int not null auto_increment,                              
       id_cuenta int not null,                              
       nombre varchar(100) not null,                              
       domicilio varchar(100),                                                           
       telefono varchar(25),                              
       geoposicion varchar(100),                              
       sexo char(1),                              
       fecha_nacimiento datetime,  
       updated_at datetime not null,
       created_at datetime not null,                               
       primary key
               (
               id
               ),
       foreign key
               (
               id_cuenta
               )
          references cuenta
               (
               id
               )
       );



create table foto_perfil
       (
       id int not null auto_increment,                              
       id_usuario int not null,                              
       nombre varchar(50) not null,   
       updated_at datetime not null,
       created_at datetime not null,                              
       primary key
               (
               id
               ),
       foreign key
               (
               id_usuario
               )
          references usuario
               (
               id
               )
       );



create table raza
       (
       id smallint not null auto_increment,                              
       id_tipo_mascota int not null,                              
       nombre varchar(100) not null,    
       updated_at datetime not null,
       created_at datetime not null,                             
       primary key
               (
               id
               ),
       foreign key
               (
               id_tipo_mascota
               )
          references tipo_mascota
               (
               id
               )
       );



create table mascota
       (
       id int not null auto_increment,                              
       id_usuario int not null,                              
       id_raza smallint not null,                                                        
       sexo char(1),                              
       edad smallint,                              
       nombre varchar(100),                              
       otras_caracteristicas text,                              
       apto_adopcion tinyint,     
       updated_at datetime not null,
       created_at datetime not null,                                                      
       primary key
               (
               id,
               id_usuario
               ),
       foreign key
               (
               id_usuario
               )
          references usuario
               (
               id
               ),
       foreign key
               (
               id_raza
               )
          references raza
               (
               id
               )
       );



create table post
       (
       id int not null auto_increment,                              
       id_mascota int not null,                              
       id_usuario int not null,                                                     
       titulo varchar(100) not null,                              
       descripcion text,      
       updated_at datetime not null,
       created_at datetime not null,                           
       primary key
               (
               id
               ),
       foreign key
               (
               id_mascota,
               id_usuario
               )
          references mascota
               (
               id,
               id_usuario
               )
       );



create table perdida
       (
       id int not null auto_increment,                              
       id_mascota int not null,                              
       id_usuario int not null,                                                          
       descripcion text,     
       updated_at datetime not null,
       created_at datetime not null,                            
       primary key
               (
               id
               ),
       foreign key
               (
               id_mascota,
               id_usuario
               )
          references mascota
               (
               id,
               id_usuario
               )
       );



create table visita
       (
       id int not null auto_increment,                              
       id_post int not null,                                 
       updated_at datetime not null,
       created_at datetime not null,                            
       primary key
               (
               id
               ),
       foreign key
               (
               id_post
               )
          references post
               (
               id
               )
       );



create table likes
       (
       id int not null auto_increment,                              
       id_post int not null,                              
       updated_at datetime not null,
       created_at datetime not null,                               
       primary key
               (
               id
               ),
       foreign key
               (
               id_post
               )
          references post
               (
               id
               )
       );



create table apto_cita
       (
       id int not null auto_increment,                              
       id_mascota int not null,                              
       id_usuario int not null,                              
       id_raza smallint,                              
       tamanio int,
       radio_km int,  
       updated_at datetime not null,
       created_at datetime not null,                               
       primary key
               (
               id
               ),
       foreign key
               (
               id_mascota,
               id_usuario
               )
          references mascota
               (
               id,
               id_usuario
               ),
       foreign key
               (
               id_raza
               )
          references raza
               (
               id
               )
       );


create table sigue
       (
       id_usuario_2 int not null,                              
       id_mascota int not null,                              
       id_usuario int not null,     
       updated_at datetime not null,
       created_at datetime not null,                            
       primary key
               (
               id_usuario_2,
               id_mascota,
               id_usuario
               ),
       foreign key
               (
               id_usuario_2
               )
          references usuario
               (
               id
               ),
       foreign key
               (
               id_mascota,
               id_usuario
               )
          references mascota
               (
               id,
               id_usuario
               )
       );



create table post_video
       (
       id_post int not null,                              
       id_video bigint not null,     
       updated_at datetime not null,
       created_at datetime not null,                            
       primary key
               (
               id_post,
               id_video
               ),
       foreign key
               (
               id_post
               )
          references post
               (
               id
               ),
       foreign key
               (
               id_video
               )
          references video
               (
               id
               )
       );



create table post_foto
       (
       id_post int not null,                              
       id_foto int not null,       
       updated_at datetime not null,
       created_at datetime not null,                          
       primary key
               (
               id_post,
               id_foto
               ),
       foreign key
               (
               id_post
               )
          references post
               (
               id
               ),
       foreign key
               (
               id_foto
               )
          references foto
               (
               id
               )
       );



create table adopta
       (
       id_mascota int not null,                              
       id_usuario int not null,                              
       id_usuario_2 int not null,                                
       updated_at datetime not null,
       created_at datetime not null,                           
       primary key
               (
               id_mascota,
               id_usuario,
               id_usuario_2
               ),
       foreign key
               (
               id_mascota,
               id_usuario
               )
          references mascota
               (
               id,
               id_usuario
               ),
       foreign key
               (
               id_usuario_2
               )
          references usuario
               (
               id
               )
       );



create table cita
       (
       id_mascota int not null,                              
       id_usuario int not null,                              
       id_mascota_2 int not null,                              
       id_usuario_2 int not null,                               
       updated_at datetime not null,
       created_at datetime not null,                          
       primary key
               (
               id_mascota,
               id_usuario,
               id_mascota_2,
               id_usuario_2
               ),
       foreign key
               (
               id_mascota,
               id_usuario
               )
          references mascota
               (
               id,
               id_usuario
               ),
       foreign key
               (
               id_mascota_2,
               id_usuario_2
               )
          references mascota
               (
               id,
               id_usuario
               )
       );



