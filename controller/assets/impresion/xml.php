<?php 




$xml = '<dte:GTDocumento xmlns:dte="http://www.sat.gob.gt/dte/fel/0.1.0" xmlns:xd="http://www.w3.org/2000/09/xmldsig#" Version="0.4">
<dte:SAT ClaseDocumento="dte">
<dte:DTE ID="DatosCertificados">
<dte:DatosEmision ID="DatosEmision">
<dte:DatosGenerales CodigoMoneda="GTQ" FechaHoraEmision="2019-04-22T16:21:28.000-06:00" Tipo="FACT"/>
<dte:Emisor AfiliacionIVA="GEN" CodigoEstablecimiento="1" CorreoEmisor="newalopez@gmail.com" NITEmisor="50510231" NombreComercial="Carlos Lopez" NombreEmisor="Carlos Lopez">
<dte:DireccionEmisor>
<dte:Direccion>string</dte:Direccion>
<dte:CodigoPostal>100</dte:CodigoPostal>
<dte:Municipio>string</dte:Municipio>
<dte:Departamento>string</dte:Departamento>
<dte:Pais>ZM</dte:Pais>
</dte:DireccionEmisor>
</dte:Emisor>
<dte:Receptor CorreoReceptor="CorreoReceptor" IDReceptor="7110588" NombreReceptor="Rodolfo Lopez">
<dte:DireccionReceptor>
<dte:Direccion>Valle de Minerva</dte:Direccion>
<dte:CodigoPostal>100</dte:CodigoPostal>
<dte:Municipio>Mixco</dte:Municipio>
<dte:Departamento>Guatemala</dte:Departamento>
<dte:Pais>GT</dte:Pais>
</dte:DireccionReceptor>
</dte:Receptor>
<dte:Frases>
<dte:Frase CodigoEscenario="1" TipoFrase="2"/>
<dte:Frase CodigoEscenario="3" TipoFrase="1"/>
</dte:Frases>
<dte:Items>
<dte:Item BienOServicio="S" NumeroLinea="1">
<dte:Cantidad>5.00</dte:Cantidad>
<dte:UnidadMedida>1</dte:UnidadMedida>
<dte:Descripcion>Catering</dte:Descripcion>
<dte:PrecioUnitario>125.00</dte:PrecioUnitario>
<dte:Precio>625.00</dte:Precio>
<dte:Descuento>65.00</dte:Descuento>
<dte:Impuestos>
<dte:Impuesto>
<dte:NombreCorto>IVA</dte:NombreCorto>
<dte:CodigoUnidadGravable>1</dte:CodigoUnidadGravable>
<dte:MontoGravable>500.00</dte:MontoGravable>
<dte:MontoImpuesto>60.00</dte:MontoImpuesto>
</dte:Impuesto>
</dte:Impuestos>
<dte:Total>560.00</dte:Total>
</dte:Item>
</dte:Items>
<dte:Totales>
<dte:TotalImpuestos>
<dte:TotalImpuesto NombreCorto="IVA" TotalMontoImpuesto="60.00"/>
</dte:TotalImpuestos>
<dte:GranTotal>560.00</dte:GranTotal>
</dte:Totales>
</dte:DatosEmision>
</dte:DTE>
</dte:SAT>
</dte:GTDocumento>';

$nombre = "archivo.xml";
$archivo = fopen($nombre,"w+");
fclose($archivo); 


 ?>