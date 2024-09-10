package dev.germantovar.springboot.entities;

import lombok.EqualsAndHashCode;
import lombok.Getter;
import lombok.Setter;
import lombok.ToString;
import javax.persistence.*;
@Entity
@Table(name = "casos")
@Setter
@Getter
@ToString
@EqualsAndHashCode
public class Clientes {
    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)

    private Long id;
    private String email;
    private String nombre;
    private String apellido;
    private String telefono;
}
