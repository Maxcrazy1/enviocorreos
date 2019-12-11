<?php
class templateEmail
{

    /**
     * La plantilla html que se envia por email
     *
     * @param mixed $url - la url tratada para enviarla por el email
     * @param mixed $title - El titulo del post
     * @param mixed $texto - El texto que compone al email
     * @param mixed $idDelete - Url con parametro para eliminar a la persona de la BD
     */
    public function template($url, $title,$texto,$idDelete)
    {
        return $temp =
          '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
            <html xmlns:v="urn:schemas-microsoft-com:vml">
              <head>
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                <meta
                  name="viewport"
                  content="width=device-width; initial-scale=1.0; maximum-scale=1.0;"
                />
                <meta
                  name="viewport"
                  content="width=600,initial-scale = 2.3,user-scalable=no"
                />
                <!--[if !mso]><!-- -->
                <link
                  href="https://fonts.googleapis.com/css?family=Nunito&display=swap"
                  rel="stylesheet"
                />
                <link
                  rel="stylesheet"
                  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.min.css"
                  integrity="sha256-zmfNZmXoNWBMemUOo1XUGFfc0ihGGLYdgtJS3KCr/l0="
                  crossorigin="anonymous"
                />
                <!-- <![endif]-->

                <title>Material Design for Bootstrap</title>

                <style type="text/css">
                  body {
                    width: 100%;
                    background-color: #ffffff;
                    margin: 0;
                    padding: 0;
                    -webkit-font-smoothing: antialiased;
                    mso-margin-top-alt: 0px;
                    mso-margin-bottom-alt: 0px;
                    mso-padding-alt: 0px 0px 0px 0px;
                  }

                  
                  .btn{
                    text-decoration: none;
                    padding: 6px;
                    padding-left: 10px;
                    padding-right: 10px;
                    font-weight: 500;
                    font-size: 20px;
                    color:#ffffff !important;
                    background-color: #A3662D;
                  }
                  .btn:hover{
                    color: #000000 !important;
                    background-color: #A3662D;
                    text-decoration: none;
                  }
                  p,
                  h1,
                  h2,
                  h3,
                  h4 {
                    color: #3f3f3f;

                    font-family: Nunito, sans-serif;

                    margin-top: 0;
                    margin-bottom: 0;
                    padding-top: 0;
                    padding-bottom: 0;
                  }

                  span.preheader {
                    display: none;
                    font-size: 1px;
                  }

                  html {
                    width: 100%;
                  }

                  table {
                    font-size: 14px;
                    border: 0;
                  }

                  .title {
                    font-family: Nunito, sans-serif;
                  }

                  .transbox {
                    margin: 30px;
                    background-color: #000000;
                    opacity: 0.6;
                    filter: alpha(opacity=65);
                    /* For IE8 and earlier */
                  }

                  /* ----------- responsivity ----------- */

                  @media only screen and (max-width: 640px) {
                    /*------ top header ------ */
                    .main-header {
                      font-size: 20px !important;
                    }

                    .main-section-header {
                      font-size: 28px !important;
                    }

                    .show {
                      display: block !important;
                    }

                    .hide {
                      display: none !important;
                    }

                    .align-center {
                      text-align: center !important;
                    }

                    .no-bg {
                      background: none !important;
                    }

                    /*----- main image -------*/
                    .main-image img {
                      width: 440px !important;
                      height: auto !important;
                    }

                    /* ====== divider ====== */
                    .divider img {
                      width: 440px !important;
                    }

                    /*-------- container --------*/
                    .container590 {
                      width: 440px !important;
                    }

                    .container580 {
                      width: 400px !important;
                    }

                    .main-button {
                      width: 220px !important;
                    }

                    /*-------- secions ----------*/
                    .section-img img {
                      width: 320px !important;
                      height: auto !important;
                    }

                    .team-img img {
                      width: 100% !important;
                      height: auto !important;
                    }
                  }

                  @media only screen and (max-width: 479px) {
                    /*------ top header ------ */
                    .main-header {
                      font-size: 18px !important;
                    }

                    .main-section-header {
                      font-size: 26px !important;
                    }

                    /* ====== divider ====== */
                    .divider img {
                      width: 280px !important;
                    }

                    /*-------- container --------*/
                    .container590 {
                      width: 280px !important;
                    }

                    .container590 {
                      width: 280px !important;
                    }

                    .container580 {
                      width: 260px !important;
                    }

                    /*-------- secions ----------*/
                    .section-img img {
                      width: 280px !important;
                      height: auto !important;
                    }
                  }
                </style>
              </head>

              <body
                class="respond"
                leftmargin="0"
                topmargin="0"
                marginwidth="0"
                marginheight="0"
              >
                <!-- pre-header -->
                <table style="display:none!important;">
                  <tr>
                    <td>
                      <div
                        style="overflow:hidden;display:none;font-size:1px;color:#ffffff;line-height:1px;font-family:Arial;maxheight:0px;max-width:0px;opacity:0;"
                      >
                        Correo semanal de proyecto Arena
                      </div>
                    </td>
                  </tr>
                </table>

                <!-- pre-header end -->

                <!-- big image section -->
                <table
                  border="0"
                  width="100%"
                  cellpadding="0"
                  cellspacing="0"
                  bgcolor="ffffff"
                  class="bg_color"
                >
                  <tr>
                    <td align="center">
                      <table
                        border="0"
                        align="center"
                        width="590"
                        cellpadding="0"
                        cellspacing="0"
                        class="container590"
                      >
                        <tr>
                          <td align="center" class="section-img bg-image">
                            <img
                              src="https://www.proyectoarena.com/wp-content/uploads/2019/09/ProyectoArena3.png"
                              style="height: 200px"
                            />
                          </td>
                        </tr>
                        <tr>
                          <td height="20" style="font-size: 20px; line-height: 20px;">
                            &nbsp;
                          </td>
                        </tr>
                        <tr>
                          <td
                            align="center"
                            style="color: #343434; font-size: 24px; font-family: Quicksand, Calibri, sans-serif; font-weight:700;letter-spacing: 3px; line-height: 35px;"
                            class="main-header"
                          ></td>
                        </tr>

                        <tr>
                          <td height="10" style="font-size: 10px; line-height: 10px;">
                            &nbsp;
                          </td>
                        </tr>

                        <tr>
                          <td align="center">
                            <table
                              border="0"
                              width="40"
                              align="center"
                              cellpadding="0"
                              cellspacing="0"
                              bgcolor="eeeeee"
                            >
                              <tr>
                                <td height="2" style="font-size: 2px; line-height: 2px;">
                                  &nbsp;
                                </td>
                              </tr>
                            </table>
                          </td>
                        </tr>

                        <tr>
                          <td height="20" style="font-size: 20px; line-height: 20px;">
                            &nbsp;
                          </td>
                        </tr>

                        <tr>
                          <td align="center">
                            <table
                              border="0"
                              width="400"
                              align="center"
                              cellpadding="0"
                              cellspacing="0"
                              class="container590"
                            >
                              <tr>
                                <td
                                  align="center"
                                  style="color: #888888; font-size: 16px; font-family: Work Sans, Calibri, sans-serif; line-height: 24px;"
                                >
                                  <div style="line-height: 24px; text-align: justify">
                                    '.$texto.'
                                  </div>
                                </td>
                              </tr>
                            </table>
                          </td>
                        </tr>

                        <tr>
                          <td height="25" style="font-size: 25px; line-height: 25px;">
                            &nbsp;
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>

                  <tr class="hide">
                    <td height="25" style="font-size: 25px; line-height: 25px;">&nbsp;</td>
                  </tr>
                  <tr>
                    <td height="40" style="font-size: 40px; line-height: 40px;">&nbsp;</td>
                  </tr>
                </table>

                <!-- end section -->

                <!--  50% image -->
                <table
                  border="0"
                  width="100%"
                  cellpadding="0"
                  cellspacing="0"
                  bgcolor="f4f4f4"
                >
                  <tr>
                    <td height="40" style="font-size: 40px; line-height: 40px;">&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="center">
                      <table
                        border="0"
                        align="center"
                        width="590"
                        cellpadding="0"
                        cellspacing="0"
                        class="container590"
                      >
                        <tr>
                          <td>
                            <table
                              border="0"
                              align="center"
                              cellpadding="0"
                              cellspacing="0"
                              style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;"
                              class="container590"
                            >
                              <tr>
                                <td align="center">
                                      <h2>'.$title.'</h2>
                                  <br />
                                </td>
                              </tr>
                              <tr>
                                <td align="center">
                                  <img
                                    href=""
                                    style=" border-style: none !important; border: 0 !important;"
                                  /><img
                                    src="https://source.unsplash.com/300x300/?kids,babies"
                                    style="display: block; width: 280px;"
                                    width="280"
                                    border="0"
                                    alt=""
                                  />
                                </td>
                              </tr>
                              <tr>
                                <td align="center">
                                  <br />
                                  <br />

                                  <a href="https://www.proyectoarena.com/'.$url.'" class="btn">Leélo ahora</a>
                                </td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>

                  <tr>
                    <td height="40" style="font-size: 40px; line-height: 40px;">&nbsp;</td>
                  </tr>
                </table>

                <!-- end section -->

                <!-- contact section -->
                <table
                  border="0"
                  width="100%"
                  cellpadding="0"
                  cellspacing="0"
                  bgcolor="ffffff"
                  class="bg_color"
                >
                  <tr class="hide">
                    <td height="25" style="font-size: 25px; line-height: 25px;">&nbsp;</td>
                  </tr>
                  <tr>
                    <td height="40" style="font-size: 40px; line-height: 40px;">&nbsp;</td>
                  </tr>

                  <tr>
                    <td
                      height="60"
                      style="border-top: 1px solid #e0e0e0;font-size: 60px; line-height: 60px;"
                    >
                      &nbsp;
                    </td>
                  </tr>

                  <tr>
                    <td align="center">
                      <table
                        border="0"
                        align="center"
                        width="590"
                        cellpadding="0"
                        cellspacing="0"
                        class="container590 bg_color"
                      >
                        <tr>
                          <td>
                            <table
                              border="0"
                              width="300"
                              align="left"
                              cellpadding="0"
                              cellspacing="0"
                              style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;"
                              class="container590"
                            >
                              <tr>
                                <!-- logo -->
                                <td align="center">
                                  <a
                                    href=""
                                    style="display: block; border-style: none !important; border: 0 !important;"
                                    ><img
                                      width="80"
                                      border="0"
                                      style="display: block; width: 80px;"
                                      src="https://www.proyectoarena.com/wp-content/uploads/2019/07/home_proyecto_arena3-02.png"
                                      alt=""
                                  /></a>
                                </td>
                              </tr>

                              <tr>
                                <td height="25" style="font-size: 25px; line-height: 25px;">
                                  &nbsp;
                                </td>
                              </tr>

                              <tr>
                                <td
                                  align="left"
                                  style="color: #888888; font-size: 14px; font-family: Work Sans, Calibri, sans-serif; line-height: 23px;"
                                  class="text_color"
                                ></td>
                              </tr>
                            </table>

                            <table
                              border="0"
                              width="200"
                              align="right"
                              cellpadding="0"
                              cellspacing="0"
                              style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;"
                              class="container590"
                            >
                              <tr>
                                <td>
                                  <table
                                    border="0"
                                    align="center"
                                    cellpadding="0"
                                    cellspacing="0"
                                  >
                                    <tr>
                                      <td>
                                        <span style="font-size: 30px; color:#B5772D;">
                                          <i class="fab fa-facebook-square"></i>
                                        </span>
                                      </td>
                                      <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                      <td>
                                        <span style="font-size: 30px; color:#B5772D;">
                                          <i class="fab fa-pinterest-square"></i>
                                        </span>
                                      </td>
                                      <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                      <td>
                                        <span style="font-size: 30px; color:#B5772D;">
                                          <i class="fab fa-twitter-square"></i>
                                        </span>
                                      </td>
                                    </tr>
                                  </table>
                                </td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>

                  <tr>
                    <td height="60" style="font-size: 60px; line-height: 60px;">&nbsp;</td>
                  </tr>
                </table>

                <!-- end section -->

                <!-- footer ====== -->
                <table
                  border="0"
                  width="100%"
                  cellpadding="0"
                  cellspacing="0"
                  bgcolor="f4f4f4"
                >
                  <tr>
                    <td height="25" style="font-size: 25px; line-height: 25px;">&nbsp;</td>
                  </tr>

                  <tr>
                    <td align="center">
                      <table
                        border="0"
                        align="center"
                        width="590"
                        cellpadding="0"
                        cellspacing="0"
                        class="container590"
                      >
                        <tr>
                          <td>
                            <table
                              border="0"
                              align="left"
                              cellpadding="0"
                              cellspacing="0"
                              style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;"
                              class="container590"
                            >
                              <tr>
                                <td
                                  align="left"
                                  style="color: #aaaaaa; font-size: 14px; font-family: Work Sans, Calibri, sans-serif; line-height: 24px;"
                                >
                                  <div style="line-height: 24px;">
                                    <span style="color: #333333;"
                                      >Equipo Proyecto Arena con cariño</span
                                    >
                                  </div>
                                </td>
                              </tr>
                            </table>

                            <table
                              border="0"
                              align="left"
                              width="5"
                              cellpadding="0"
                              cellspacing="0"
                              style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;"
                              class="container590"
                            >
                              <tr>
                                <td
                                  height="20"
                                  width="5"
                                  style="font-size: 20px; line-height: 20px;"
                                >
                                  &nbsp;
                                </td>
                              </tr>
                            </table>

                            <table
                              border="0"
                              align="right"
                              cellpadding="0"
                              cellspacing="0"
                              style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;"
                              class="container590"
                            >
                              <tr>
                                <td align="center">
                                  <table
                                    align="center"
                                    border="0"
                                    cellpadding="0"
                                    cellspacing="0"
                                  >
                                    <tr>
                                      <td align="center">
                                        <a
                                          style="font-size: 14px; font-family: Work Sans, Calibri, sans-serif; line-height: 24px;color: rgb(150, 150, 150); text-decoration: none;font-weight:bold;"
                                          href="https://www.proyectoarena.com/enviocorreos/deleteEmail.php?key="' . $idDelete.'"
                                          >Eliminar suscripción</a
                                        >
                                      </td>
                                    </tr>
                                  </table>
                                </td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>

                  <tr>
                    <td height="25" style="font-size: 25px; line-height: 25px;">&nbsp;</td>
                  </tr>
                </table>

                <!-- end footer ====== -->
              </body>
            </html>

          ';

    }

}
