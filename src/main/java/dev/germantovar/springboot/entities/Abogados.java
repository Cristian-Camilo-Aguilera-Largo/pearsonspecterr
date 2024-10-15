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

    @ManyToOne
    @JoinColumn(name = "id_usuario")
    private Usuarios usuarios;

    private String nombre;
    private String cedula;
    private String telefono;
    private String correo;
    private String especializacion;
    private String cargo;

    @OneToMany(mappedBy = "abogados")
    @JsonManagedReference
    private List<Clientes> clientes;


}