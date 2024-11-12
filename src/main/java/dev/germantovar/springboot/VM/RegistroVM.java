package dev.germantovar.springboot.VM;

import lombok.Data;
import lombok.Getter;
import lombok.Setter;

@Setter
@Getter
@Data
public class RegistroVM {
    private Long idUsuario;
    private String nombre;
    private String apellido;
    private String telefono;
    private String email;
    private String username;
    private String password;
}
