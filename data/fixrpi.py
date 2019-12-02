with open('./rpi_courses.csv', errors='ignore') as f:
    with open('./rpi_fixed.csv', 'w') as r:
        for line in f:
            if line.strip() == '"':
                print(line)
                continue
            line = line.encode('ascii', errors='ignore').decode()
            if line[:4].upper() != line[:4]:
                continue
            if line[0] == '?':
                continue

            line = line.replace('"', '')
            r.write(line)
