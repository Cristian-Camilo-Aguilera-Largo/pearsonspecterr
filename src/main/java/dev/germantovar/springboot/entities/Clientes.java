package dev.germantovar.springboot.entities;

import com.fasterxml.jackson.annotation.JsonBackReference;
import lombok.EqualsAndHashCode;
import lombok.Getter;
import lombok.Setter;
import lombok.ToString;
import javax.persistence.*;
@Entity
@Table(name = "clientes")
@Setter
@Getter
@ToString
@EqualsAndHashCode
public class Clientes {
    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id;

    @ManyToOne
    @JoinColumn(name = "id_usuario")
    private Usuarios usuarios;

    private String email;
    private String nombre;
    private String apellido;
    private String telefono;
}
