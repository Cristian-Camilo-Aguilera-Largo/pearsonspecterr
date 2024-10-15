package dev.germantovar.springboot.entities;

import lombok.EqualsAndHashCode;
import lombok.Getter;
import lombok.Setter;
import lombok.ToString;
import javax.persistence.*;
@Entity
@Table(name = "usuarios")
@Setter
@Getter
@ToString
@EqualsAndHashCode
public class Usuarios {
    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id_usuario;

    @ManyToOne
    @JoinColumn(name = "id_rol")
    private Roles roles;

    private String User;
    private String Pass;
}
