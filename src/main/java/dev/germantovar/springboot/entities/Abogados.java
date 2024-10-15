package dev.germantovar.springboot.entities;
import com.fasterxml.jackson.annotation.JsonManagedReference;
import lombok.EqualsAndHashCode;
import lombok.Getter;
import lombok.Setter;
import lombok.ToString;
import javax.persistence.*;
import java.util.List;

@Entity
@Table(name = "abogados")
@Setter
@Getter
@ToString
@EqualsAndHashCode
public class Abogados {
    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id;
    private String nombre;
    private String Apellido;
    private String cedula;
    private String telefono;
    private String correo;

    @OneToOne
    @JoinColumn(name = "id_especializacion")
    private Especializacion especializacion;

    @OneToMany(mappedBy = "abogados")
    @JsonManagedReference
    private List<Clientes> clientes;

    private String cargo;
    private String contraseña;
}