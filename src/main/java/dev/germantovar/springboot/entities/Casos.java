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
public class Casos {
    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id;

    @ManyToOne
    @JoinColumn(name = "id_abogado")
    private Abogados abogados;

    @ManyToOne
    @JoinColumn(name = "id_cliente")
    private Clientes clientes;

    private String caso;
    private String descripcion;
    private String fecha_ic;
    private String estado;
    private String fecha_ct;
}
