--
-- PostgreSQL database dump
--

-- Dumped from database version 14.18
-- Dumped by pg_dump version 14.18

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: permissions; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.permissions (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    guard_name character varying(255) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    modules text
);


ALTER TABLE public.permissions OWNER TO postgres;

--
-- Name: permissions_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.permissions_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.permissions_id_seq OWNER TO postgres;

--
-- Name: permissions_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.permissions_id_seq OWNED BY public.permissions.id;


--
-- Name: permissions id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.permissions ALTER COLUMN id SET DEFAULT nextval('public.permissions_id_seq'::regclass);


--
-- Data for Name: permissions; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.permissions (id, name, guard_name, created_at, updated_at, modules) FROM stdin;
1	tambah data user	web	2026-05-25 09:37:50	2026-05-25 09:37:50	User
2	lihat daftar user	web	2026-05-25 09:37:50	2026-05-25 09:37:50	User
3	ubah data user	web	2026-05-25 09:37:50	2026-05-25 09:37:50	User
4	hapus data user	web	2026-05-25 09:37:50	2026-05-25 09:37:50	User
5	tambah data role	web	2026-05-25 09:37:50	2026-05-25 09:37:50	Role
6	lihat daftar role	web	2026-05-25 09:37:50	2026-05-25 09:37:50	Role
7	ubah data role	web	2026-05-25 09:37:50	2026-05-25 09:37:50	Role
8	hapus data role	web	2026-05-25 09:37:50	2026-05-25 09:37:50	Role
9	tambah data dokter	web	2026-05-25 09:37:50	2026-05-25 09:37:50	Dokter
10	lihat data dokter	web	2026-05-25 09:37:50	2026-05-25 09:37:50	Dokter
11	lihat daftar dokter	web	2026-05-25 09:37:50	2026-05-25 09:37:50	Dokter
12	ubah data dokter	web	2026-05-25 09:37:50	2026-05-25 09:37:50	Dokter
13	hapus data dokter	web	2026-05-25 09:37:50	2026-05-25 09:37:50	Dokter
14	lihat daftar obat	web	2026-05-25 09:37:50	2026-05-25 09:37:50	Obat
15	tambah data obat	web	2026-05-25 09:37:50	2026-05-25 09:37:50	Obat
16	lihat data obat	web	2026-05-25 09:37:50	2026-05-25 09:37:50	Obat
17	ubah data obat	web	2026-05-25 09:37:50	2026-05-25 09:37:50	Obat
18	hapus data obat	web	2026-05-25 09:37:50	2026-05-25 09:37:50	Obat
19	lihat daftar pasien	web	2026-05-25 09:37:50	2026-05-25 09:37:50	Pasien
20	tambah data pasien	web	2026-05-25 09:37:50	2026-05-25 09:37:50	Pasien
21	lihat data pasien	web	2026-05-25 09:37:50	2026-05-25 09:37:50	Pasien
22	ubah data pasien	web	2026-05-25 09:37:50	2026-05-25 09:37:50	Pasien
23	hapus data pasien	web	2026-05-25 09:37:50	2026-05-25 09:37:50	Pasien
\.


--
-- Name: permissions_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.permissions_id_seq', 23, true);


--
-- Name: permissions permissions_name_guard_name_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.permissions
    ADD CONSTRAINT permissions_name_guard_name_unique UNIQUE (name, guard_name);


--
-- Name: permissions permissions_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.permissions
    ADD CONSTRAINT permissions_pkey PRIMARY KEY (id);


--
-- PostgreSQL database dump complete
--

