package dev.germantovar.springboot.controllers;

import dev.germantovar.springboot.entities.Casos;
import dev.germantovar.springboot.entities.Abogados; // Asegúrate de importar la entidad Abogados
import dev.germantovar.springboot.entities.Clientes;
import dev.germantovar.springboot.repository.CasosRepository;
import dev.germantovar.springboot.repository.AbogadosRepository; // Asegúrate de tener acceso a este repositorio
import dev.germantovar.springboot.services.ICasosService;
import dev.germantovar.springboot.repository.ClientesRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.util.List;

//parcial
@RestController
public class CasosController {

    @Autowired
    private ICasosService service;


    @Autowired
    CasosRepository casosRepository;

    @Autowired
    AbogadosRepository abogadosRepository;

    @Autowired
    ClientesRepository clientesRepository;

    @GetMapping("tipificacion1")
    public List<Casos> getAll() {
        return service.getAll();
    }

    @PostMapping("envio")
    public ResponseEntity<?> save(@RequestBody CasosRequest casosRequest) {
        // Busca el abogado por su ID
        Abogados abogado = abogadosRepository.findById(casosRequest.getIdAbogado())
                .orElseThrow(() -> new RuntimeException("Abogado no encontrado"));
        Clientes cliente = clientesRepository.findById(casosRequest.getIdClientes())
                .orElseThrow(() -> new RuntimeException("Cliente no encontrado"));

        Casos caso = new Casos();
        caso.setAbogados(abogado); // Asigna el objeto Abogados al caso
        caso.setClientes(cliente);
        caso.setCaso(casosRequest.getCaso());
        caso.setDescripcion(casosRequest.getDescripcion());
        caso.setFecha_ic(casosRequest.getFechaIc());
        caso.setEstado(casosRequest.getEstado());
        caso.setFecha_ct(casosRequest.getFechaCt());

        service.save(caso);
        return ResponseEntity.ok(caso); // Retorna el caso guardado como respuesta
    }
}
