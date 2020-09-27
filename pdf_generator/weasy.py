import sys, zlib

def main(fn):
    data = open(fn, 'rb').read()
    i = 0
    first = True
    last = None
    while True:
        i = data.find(b'>>\nstream\n', i)
        if i == -1:
            break
        i += 10
        try:
            last = cdata = zlib.decompress(data[i:])
            if first:
                first = False
            else:
                pass#print cdata
        except:
            pass
    print(last.decode('utf-8'))

if __name__=='__main__':
    main(*sys.argv[1:])