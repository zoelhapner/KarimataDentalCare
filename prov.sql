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

--
-- Data for Name: provinces; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.provinces (id, name, country_id, is_active) FROM stdin;
1	Aceh	1	t
2	Sumatera Utara	1	t
3	Sumatera Barat	1	t
4	Riau	1	t
5	Jambi	1	t
6	Sumatera Selatan	1	t
7	Bengkulu	1	t
8	Lampung	1	t
9	Kepulauan Bangka Belitung	1	t
10	Kepulauan Riau	1	t
11	Dki Jakarta	1	t
12	Jawa Barat	1	t
13	Jawa Tengah	1	t
14	Di Yogyakarta	1	t
15	Jawa Timur	1	t
16	Banten	1	t
17	Bali	1	t
18	Nusa Tenggara Barat	1	t
19	Nusa Tenggara Timur	1	t
20	Kalimantan Barat	1	t
21	Kalimantan Tengah	1	t
22	Kalimantan Selatan	1	t
23	Kalimantan Timur	1	t
24	Kalimantan Utara	1	t
25	Sulawesi Utara	1	t
26	Sulawesi Tengah	1	t
27	Sulawesi Selatan	1	t
28	Sulawesi Tenggara	1	t
29	Gorontalo	1	t
30	Sulawesi Barat	1	t
31	Maluku	1	t
32	Maluku Utara	1	t
33	Papua Barat	1	t
34	Papua	1	t
\.


--
-- Name: provinces_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.provinces_id_seq', 1, false);


--
-- PostgreSQL database dump complete
--

